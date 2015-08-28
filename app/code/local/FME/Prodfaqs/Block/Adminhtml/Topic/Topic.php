<?php
/**
 * FAQs And Product Questions
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   FME
 * @package    FAQs And Product Questions
 * @author     Asif Hussain <support@fmeextensions.com>
 * 	       
 * @copyright  Copyright 2012 � www.fmeextensions.com All right reserved
 */

class FME_Prodfaqs_Block_Adminhtml_Topic extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'prodfaqs';
        $this->_controller = 'adminhtml_topic';
        
        $this->_updateButton('save', 'label', Mage::helper('prodfaqs')->__('Save Topic'));
        $this->_updateButton('delete', 'label', Mage::helper('prodfaqs')->__('Delete Topic'));
		
    }

    public function getHeaderText()
    {
        if( Mage::registry('topic_data') ) {
            return Mage::helper('prodfaqs')->__("Edit Topic");
        }
    }
}