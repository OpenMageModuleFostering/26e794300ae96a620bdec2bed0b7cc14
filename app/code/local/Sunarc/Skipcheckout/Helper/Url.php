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
class Sunarc_Skipcheckout_Helper_Url extends Mage_Core_Helper_Abstract
{
    protected $_isSecure;
    /**
     * Returns a true/false if the current page is https or not
     * @return boolean
     */
    public function getIsSecure()
    {
        if ($this->_isSecure == null) {
            $this->_isSecure = Mage::app()->getStore()->isCurrentlySecure();
        } // end if
        return $this->_isSecure;
    } // end
    /**
     *
     */
    public function getProgressUrl()
    {
        return Mage::getUrl(
            'skipcheckout/onepage/progress', array(
            "_secure" => $this->getIsSecure()
            )
        );
    } // end
    public function getReviewUrl()
    {
        return Mage::getUrl(
            'skipcheckout/onepage/review', array(
            "_secure" => $this->getIsSecure()
            )
        );
    } // end
    public function getSaveMethodUrl()
    {
        return Mage::getUrl(
            'skipcheckout/onepage/saveMethod', array(
            "_secure" => $this->getIsSecure()
            )
        );
    }
    public function getFailureUrl()
    {
        return Mage::getUrl(
            'checkout/cart', array(
            "_secure" => $this->getIsSecure()
            )
        );
    }
    public function getAddressUrl()
    {
        return Mage::getUrl(
            'skipcheckout/onepage/getAddress', array(
            "_secure" => $this->getIsSecure()
            )
        );
    } // end
    public function getSaveBillingUrl()
    {
        return Mage::getUrl(
            'skipcheckout/onepage/saveBilling', array(
            "_secure" => $this->getIsSecure()
            )
        );
    } // end
    public function getSaveShippingUrl()
    {
        return Mage::getUrl(
            'skipcheckout/onepage/saveShipping', array(
            "_secure" => $this->getIsSecure()
            )
        );
    }
    public function getSaveShippingMethod()
    {
        return Mage::getUrl(
            'skipcheckout/onepage/saveShippingMethod', array(
            "_secure" => $this->getIsSecure()
            )
        );
    }
    public function getSavePaymentUrl()
    {
        return Mage::getUrl(
            'skipcheckout/onepage/savePayment', array(
            "_secure" => $this->getIsSecure()
            )
        );
    }
} // end class