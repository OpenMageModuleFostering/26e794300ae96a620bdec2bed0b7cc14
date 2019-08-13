<?php
class Sunarc_Skipcheckout_Adminhtml_SkipcheckoutController extends Mage_Adminhtml_Controller_Action
{
    /**
     *
     */
    public function issecureenabledAction()
    {
        $value = Mage::getStoreConfig('web/secure/base_url', Mage::app()->getStore());
        echo $value;
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
        echo $value;
        return;
    } // end
} // end 