<?php
class Sunarc_Skipcheckout_Model_System_Config_Source_Shipping_Enabledmethods
{
    public function toOptionArray()
    {
        $active_carriers           = Mage::getSingleton('shipping/config')->getActiveCarriers();
        $carrier_methods           = array();
        $carrier_methods['noskip'] = Mage::helper('sunarc_skipcheckout')->__("Do not skip [Default]");
        foreach ($active_carriers as $code => $carrier) {
            $label   = Mage::getStoreConfig('carriers/' . $code . '/title');
            $enabled = Mage::getStoreConfig('carriers/' . $code . '/active');
            $methods = $carrier->getAllowedMethods();
            foreach ($methods as $method_code => $method_label) {
                if ($label != null && $enabled == 1) {
                    $carrier_methods[$code . '_' . $method_code] = $label . " [" . $method_label . "]";
                } // end
            }
        } // end
        return $carrier_methods;
    } // end fun
} // end class
