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
class Sunarc_Skipcheckout_Model_System_Config_Source_Payment_Enabledmethods
{
    public function toOptionArray()
    {
        $activeMethods    = Mage::getSingleton('payment/config')->getActiveMethods();
        $methods           = array();
        $methods['noskip'] = Mage::helper('sunarc_skipcheckout')->__("Do not skip [Default]");
        foreach ($activeMethods as $code => $value) {
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
