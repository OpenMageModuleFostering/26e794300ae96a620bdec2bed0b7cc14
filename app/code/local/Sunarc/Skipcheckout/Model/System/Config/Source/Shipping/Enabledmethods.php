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
class Sunarc_Skipcheckout_Model_System_Config_Source_Shipping_Enabledmethods
{
    public function toOptionArray()
    {
        $activeCarriers           = Mage::getSingleton('shipping/config')->getActiveCarriers();
        $carrierMethods           = array();
        $carrierMethods['noskip'] = Mage::helper('sunarc_skipcheckout')->__("Do not skip [Default]");
        foreach ($activeCarriers as $code => $carrier) {
            $label   = Mage::getStoreConfig('carriers/' . $code . '/title');
            $enabled = Mage::getStoreConfig('carriers/' . $code . '/active');
            $methods = $carrier->getAllowedMethods();
            foreach ($methods as $methodCode => $methodLabel) {
                if ($label != null && $enabled == 1) {
                    $carrierMethods[$code . '_' . $methodCode] = $label . " [" . $methodLabel . "]";
                } // end
            }
        } // end
        return $carrierMethods;
    } // end fun
} // end class
