<?php
class Sunarc_Skipcheckout_Model_System_Config_Source_Payment_Enabledmethods
{
    public function toOptionArray()
    {
        $active_methods    = Mage::getSingleton('payment/config')->getActiveMethods();
        $methods           = array();
        $methods['noskip'] = Mage::helper('sunarc_skipcheckout')->__("Do not skip [Default]");
        foreach ($active_methods as $code => $value) {
            switch ($code) {
                // we can't skip this method so make sure its not added to the array
                case "ccsave":
                    break;
                default:
                    $label          = Mage::getStoreConfig('payment/' . $code . '/title');
                    $methods[$code] = $label;
                    break;
            } // end
        } // end
        return $methods;
    } // end fun
} // end class