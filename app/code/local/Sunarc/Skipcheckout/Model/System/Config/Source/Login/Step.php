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
class Sunarc_Skipcheckout_Model_System_Config_Source_Login_Step
{
    public function toOptionArray()
    {
        return array(
            "0" => "Default Magento login",
            "1" => "Skip Magento Login"
        );
    } // end 
}
