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
class Sunarc_Skipcheckout_Model_Observer extends Mage_Core_Model_Observer
{
    public function checkSkipCheckout(Varien_Event_Observer $observer)
    {
        // exit now if reduced checkout is not enabled or this is not checkout_onepage_index
        if ($this->isSkipCheckoutEnabled() == false) {
            return;
        }

        $handles       = $observer->getEvent()->getLayout()->getUpdate()->getHandles();
        $this->_update = $observer->getEvent()->getLayout()->getUpdate();
        // find the handle we're looking for
        if (array_search('checkout_onepage_index', $handles) == true) {
            $this->_update->addHandle('sunarc_checkout_skip');
            $this->_loginStepHandle();
            $this->_paymentStepHandle();
            $this->_shippingStepHandle();
            $this->_telephoneFaxHandle();
            return;
        } // end
        // find the handle we're looking for
        if (array_search('customer_address_form', $handles) == true) {
            $this->_telephoneFaxHandle();
            return;
        } // end
        return;
    } // end	
    /**
     * Adds the handle "sunarc_checkout_skip_forceguestonly"
     * @see app/design/frontend/base/default/layout/sunarc/skipcheckout/skipcheckout.xml
     */
    protected function _loginStepHandle()
    {
        // should we remove the login step..
        if (Mage::getSingleton('customer/session')->isLoggedIn()
            == false && Mage::helper('sunarc_skipcheckout/data')->isLoginStepGuestOnly() == true) {
            $this->getUpdate()->addHandle('sunarc_checkout_skip_forceguestonly');
        } // end
    } // end
    /**
     * Adds the Handle "sunarc_checkout_skip_skip_shippingmethod"
     * @see app/design/frontend/base/default/layout/sunarc/skipcheckout/skipcheckout.xml
     */
    protected function _paymentStepHandle()
    {
        // should we remove the payment method step..
        if (Mage::helper('sunarc_skipcheckout/data')->skipShippingMethod() == true) {
            $this->getUpdate()->addHandle('sunarc_checkout_skip_skip_shippingmethod');
        } // end
    } // end
    /**
     * Adds the Handle "sunarc_checkout_skip_skip_paymentmethod"
     * @see app/design/frontend/base/default/layout/sunarc/skipcheckout/skipcheckout.xml
     */
    protected function _shippingStepHandle()
    {
        // should we remove the shipping method step..
        if (Mage::helper('sunarc_skipcheckout/data')->skipPaymentMethod() == true) {
            $this->getUpdate()->addHandle('sunarc_checkout_skip_skip_paymentmethod');
        } // end
    } // end
    /**
     * Adds the Handle "sunarc_checkout_skip_hide_telephonefax"
     * @see app/design/frontend/base/default/layout/sunarc/skipcheckout/skipcheckout.xml
     */
    protected function _telephoneFaxHandle()
    {
        // hide the telphone input fields
        // end
    } // end
    /**
     * Returns true if the the user is not logged in and email doesn't already exist.
     * @return boolean
     */
    protected function _isValidGuest()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn() || $this->_customerExists()) {
            return false;
        } // end
        return true;
    } // end 
    /**
     * Returns true if the last order's email address already exists
     * @return boolean
     */
    protected function _customerExists()
    {
        $helper   = Mage::helper('sunarc_skipcheckout/order');
        $email    = $helper->getEmail();
        $customer = Mage::getSingleton('customer/customer')->setStore(Mage::app()->getStore())->loadByEmail($email);
        if ($customer->getId()) {
            return true;
        } // end 
        return false;
    } // end 
    /**
     * Returns true if Reduced Checkout is Enabled in the Admin Configuration
     *
     * @return boolean
     */
    protected function isSkipCheckoutEnabled()
    {
        $enabled = Mage::getStoreConfig('sunarc_skipcheckout_settings/skipcheckout/isenabled');
        // return early if we're not enabled
        if ($enabled != true) {
            return false;
        } // end
        return true;
    } // end
    protected function getUpdate()
    {
        return $this->_update;
    } // end	
} // end

