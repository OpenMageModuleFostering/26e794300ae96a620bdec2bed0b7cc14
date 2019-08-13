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
class Sunarc_Skipcheckout_Helper_Order extends Mage_Core_Helper_Abstract
{
    /**
     * We use this during the user signup phase.
     * @var string
     */
    public $sessionKey = 'skipcheckout_register_key';
    public function getSessionKey()
    {
        return $this->sessionKey;
    } // end 
    public function getOrder()
    {
        //get the order id from the session
        $session     = Mage::getSingleton('checkout/session');
        $lastOrderId = $session->getLastOrderId();
        // load the order
        $order       = Mage::getSingleton('sales/order');
        $order->load($lastOrderId);
        return $order;
    } // end
    /**
     *
     * @return Ambigous <mixed, unknown, multitype:>
     */
    public function getEmail()
    {
        $order = $this->getOrder();
        // get the orders email address
        $email = $order->getCustomerEmail();
        return $email;
    } // end
}
