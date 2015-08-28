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

class FME_Prodfaqs_Block_Adminhtml_Prodfaqs extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_prodfaqs';
    $this->_blockGroup = 'prodfaqs';
    $this->_headerText = Mage::helper('prodfaqs')->__('Faqs Management');
    $this->_addButtonLabel = Mage::helper('prodfaqs')->__('Add New Faq');
    parent::__construct();
    
  }
}