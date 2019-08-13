<?php
class Sunarc_Skipcheckout_Helper_Url extends Mage_Core_Helper_Abstract
{
    protected $is_secure;
    /**
     * Returns a true/false if the current page is https or not
     * @return boolean
     */
    public function getIsSecure()
    {
        if ($this->is_secure == null) {
            $this->is_secure = Mage::app()->getStore()->isCurrentlySecure();
        } // end if
        return $this->is_secure;
    } // end
    /**
     *
     */
    public function getProgressUrl()
    {
        return Mage::getUrl('skipcheckout/onepage/progress', array(
            "_secure" => $this->getIsSecure()
        ));
    } // end
    public function getReviewUrl()
    {
        return Mage::getUrl('skipcheckout/onepage/review', array(
            "_secure" => $this->getIsSecure()
        ));
    } // end
    public function getSaveMethodUrl()
    {
        return Mage::getUrl('skipcheckout/onepage/saveMethod', array(
            "_secure" => $this->getIsSecure()
        ));
    }
    public function getFailureUrl()
    {
        return Mage::getUrl('checkout/cart', array(
            "_secure" => $this->getIsSecure()
        ));
    }
    public function getAddressUrl()
    {
        return Mage::getUrl('skipcheckout/onepage/getAddress', array(
            "_secure" => $this->getIsSecure()
        ));
    } // end
    public function getSaveBillingUrl()
    {
        return Mage::getUrl('skipcheckout/onepage/saveBilling', array(
            "_secure" => $this->getIsSecure()
        ));
    } // end
    public function getSaveShippingUrl()
    {
        return Mage::getUrl('skipcheckout/onepage/saveShipping', array(
            "_secure" => $this->getIsSecure()
        ));
    }
    public function getSaveShippingMethod()
    {
        return Mage::getUrl('skipcheckout/onepage/saveShippingMethod', array(
            "_secure" => $this->getIsSecure()
        ));
    }
    public function getSavePaymentUrl()
    {
        return Mage::getUrl('skipcheckout/onepage/savePayment', array(
            "_secure" => $this->getIsSecure()
        ));
    }
} // end class