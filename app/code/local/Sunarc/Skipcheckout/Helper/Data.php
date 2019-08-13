<?php
/**
 *
 *
 * @category Sunarc
 * @package Customize Checkout Steps-magento
 * @author Sunarc Team <info@sunarctechnologies.com>
 * @copyright Sunarc (http://sunarctechnologies.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Sunarc_Skipcheckout_Helper_Data extends Mage_Core_Helper_Abstract
{
    const LOGIN_STEP_DEFAULT = 0;
    const LOGIN_STEP_GUESTONLY = 1;
    const LOGIN_STEP_CUSTOM = 2;
    public function getPaymentMethod()
    {
        $value = Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout/default_payment');
        return $value;
    } // end
    public function getShippingMethod()
    {
        $value = Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout/default_shipping');
        return $value;
    } // end
    public function isLoginStepDefault()
    {
        return ($this->getLoginStepType() == self::LOGIN_STEP_DEFAULT);
    } // end
    public function isLoginStepGuestOnly()
    {
        return ($this->getLoginStepType() == self::LOGIN_STEP_GUESTONLY);
    } // end
    public function isLoginStepCustom()
    {
        return ($this->getLoginStepType() == self::LOGIN_STEP_CUSTOM);
    } // end 
    protected function getLoginStepType()
    {
        $value = Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout/loginstep_type');
        return $value;
    } // end	
    public function isFix28112Enabled()
    {
        $value = Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout/enable28112fix');
        return $value;
    } // end
    public function hideTelephoneAndFax()
    {
        $value = Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout/hide_telephone_fax');
        return $value;
    } // end
    public function guestsCanRegisterOnOrderSuccess()
    {
        $value = Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout/register_on_order_success');
        return $value;
    } // end
    public function getCMSBlockIdForOrderSuccessForm()
    {
        $value = Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout/register_on_order_success_cms_block');
        return $value;
    } // end
    public function getCustomerGroupsEnabled()
    {
        $value = 
            Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout_customergroups/customergroups_enabled');
        return $value;
    } // end 
    public function getShippingCustomerGroups()
    {
        if ($this->getCustomerGroupsEnabled() == 0) {
            return array();
        } // end
        $value = 
            Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout_customergroups/shipping_noskip_customergroups');
        $value = explode(',', $value);
        return $value;
    } // end
    public function getPaymentCustomerGroups()
    {
        if ($this->getCustomerGroupsEnabled() == 0) {
            return array();
        } // end
        $value =
            Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout_customergroups/payment_noskip_customergroups');
        $value = explode(',', $value);
        return $value;
    } // end
    /**
     * Returns the current logged in customers group.
     * If the customer is not logged in return false
     *
     * @return boolean
     */
    protected function getCurrentCustomersGroup()
    {
        // Check Customer is loggedin or not
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            // Get group Id
            $groupId = Mage::getSingleton('customer/session')->getCustomerGroupId();
            return $groupId;
            //Get customer Group name
        } // end
        return false;
    } // end
    /**
     * Returns true if we should force the payment method
     * @return boolean
     */
    public function skipPaymentMethod()
    {
        $code          = $this->getPaymentMethod();
        $noskipGroups = $this->getPaymentCustomerGroups();
        $currentGroup = $this->getCurrentCustomersGroup();
        switch ($code) {
            case "noskip":
                $return = false;
                break;
            default:
                $return = $this->skipThisSection($currentGroup, $noskipGroups);
                break;
        } // end sw
        return $return;
    } // end fun
    /**
     * Returns true if we should force the shipping method
     * @return boolean
     */
    public function skipShippingMethod()
    {
        $code          = $this->getShippingMethod();
        $noskipGroups = $this->getShippingCustomerGroups();
        $currentGroup = $this->getCurrentCustomersGroup();
        switch ($code) {
            case "noskip":
                $return = false;
                break;
            default:
                $return = $this->skipThisSection($currentGroup, $noskipGroups);
                break;
        }

        return $return;
    } // end fun
    /**
     * Returns true if we should skip this section
     *
     * @param int $currentGroup customers group id
     * @param array $noskipGroups array of groupid's
     */
    private function skipThisSection($currentGroup, $noskipGroups)
    {
        // if we find the current users groupid in the "dont skip" array, tell checkout not to skip this section
        if ($currentGroup !== false && is_array($noskipGroups) && array_search($currentGroup, $noskipGroups) > -1) {
            return false;
        } // end
        return true;
    } // end
}

