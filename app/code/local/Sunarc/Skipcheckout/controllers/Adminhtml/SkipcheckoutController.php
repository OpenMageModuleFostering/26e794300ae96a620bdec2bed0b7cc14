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
class Sunarc_Skipcheckout_Adminhtml_SkipcheckoutController extends Mage_Adminhtml_Controller_Action
{
    /**
     *
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sunarc/skipcheckout/sunarc_skipcheckout_settings');
        //or at least

    }
    public function issecureenabledAction()
    {
        $value = Mage::getStoreConfig('web/secure/base_url', Mage::app()->getStore());
        return;
    } // end
    /**
     *
     */
    public function isfrontendsslAction()
    {
        $value = Mage::getStoreConfig('web/secure/use_in_frontend', Mage::app()->getStore());
        switch ($value) {
            case "1":
                $value = 'Enabled';
                break;
            default:
                $value = 'Disabled';
                break;
        } // end 
        return;
    } // end
} // end 