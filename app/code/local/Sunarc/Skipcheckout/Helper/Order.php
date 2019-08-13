<?php
class Sunarc_Skipcheckout_Helper_Order extends Mage_Core_Helper_Abstract
{
    /**
     * We use this during the user signup phase.
     * @var string
     */
    public $_session_key = 'skipcheckout_register_key';
    public function getSessionKey()
    {
        return $this->_session_key;
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