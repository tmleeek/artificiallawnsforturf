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

class FME_Prodfaqs_Block_Adminhtml_Prodfaqs_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'prodfaqs';
        $this->_controller = 'adminhtml_prodfaqs';
        
        $this->_updateButton('save', 'label', Mage::helper('prodfaqs')->__('Save Faq'));
        $this->_updateButton('delete', 'label', Mage::helper('prodfaqs')->__('Delete Faq'));
		
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('faq_answar') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'faq_answar');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'faq_answar');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('faqs_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('faqs_data') && Mage::registry('faqs_data')->getId() ) {
            return Mage::helper('prodfaqs')->__("Edit Faq '%s'", $this->htmlEscape(Mage::registry('faqs_data')->getTitle()));
        } else {
            return Mage::helper('prodfaqs')->__('Add Faq');
        }
    }
}