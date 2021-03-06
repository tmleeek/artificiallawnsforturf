<?php


class Tentura_Ngroups_Block_Adminhtml_Newsletter_Queue_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $queue = Mage::getSingleton('newsletter/queue');

        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    =>  Mage::helper('newsletter')->__('Queue Information')
        ));

        $outputFormat = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);

        if($queue->getQueueStatus() == Mage_Newsletter_Model_Queue::STATUS_NEVER) {
            $fieldset->addField('date', 'date',array(
                'name'      =>    'start_at',
                'time'      =>    true,
                'format'    =>    $outputFormat,
                'label'     =>    Mage::helper('newsletter')->__('Queue Date Start'),
                'image'     =>    $this->getSkinUrl('images/grid-cal.gif')
            ));

            if (!Mage::app()->isSingleStoreMode()) {
                $fieldset->addField('stores','multiselect',array(
                    'name'          => 'stores[]',
                    'label'         => Mage::helper('newsletter')->__('Subscribers From'),
                    'image'         => $this->getSkinUrl('images/grid-cal.gif'),
                    'values'        => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(),
                    'value'         => $queue->getStores()
                ));
            }
            else {
                $fieldset->addField('stores', 'hidden', array(
                    'name'      => 'stores[]',
                    'value'     => Mage::app()->getStore(true)->getId()
                ));
            }
        } else {
            $fieldset->addField('date','date',array(
                'name'      => 'start_at',
                'time'      => true,
                'disabled'  => 'true',
                'format'    => $outputFormat,
                'label'     => Mage::helper('newsletter')->__('Queue Date Start'),
                'image'     => $this->getSkinUrl('images/grid-cal.gif')
            ));

            if (!Mage::app()->isSingleStoreMode()) {
                $fieldset->addField('stores','multiselect',array(
                    'name'          => 'stores[]',
                    'label'         => Mage::helper('newsletter')->__('Subscribers From'),
                    'image'         => $this->getSkinUrl('images/grid-cal.gif'),
                    'required'      => true,
                    'values'        => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(),
                    'value'         => $queue->getStores()
                ));
            }
            else {
                $fieldset->addField('stores', 'hidden', array(
                    'name'      => 'stores[]',
                    'value'     => Mage::app()->getStore(true)->getId()
                ));
            }
        }

        if ($queue->getQueueStartAt()) {
            $form->getElement('date')->setValue(
                Mage::app()->getLocale()->date($queue->getQueueStartAt(), Varien_Date::DATETIME_INTERNAL_FORMAT)
            );
        }

        $subscriberGroups = Mage::getModel('ngroups/ngroups')->getCollection()->toArray();
        $groupsOptionArray = array();
        $groupsOptionArray[0]['value'] = '';
        $groupsOptionArray[0]['label'] = '';
        $i = 1;
        foreach ($subscriberGroups['items'] as $subscriberGroup){
            $groupsOptionArray[$i]['value'] = $subscriberGroup['ngroups_id'];
            $groupsOptionArray[$i]['label'] = $subscriberGroup['title'];
            $i++;

        }

        $fieldset->addField('user_group', 'select', array(
          'label'     => Mage::helper('ngroups')->__('Template for Subscribers Group'),
          'name'      => 'user_group',
          'values'    => $groupsOptionArray,
          'value'     => $queue->getUserGroup(),
       ));

        $fieldset->addField('subject', 'text', array(
            'name'      =>'subject',
            'label'     => Mage::helper('newsletter')->__('Subject'),
            'required'  => true,
            'value'     => $queue->getTemplate()->getTemplateSubject()
        ));

        $fieldset->addField('sender_name', 'text', array(
            'name'      =>'sender_name',
            'label'     => Mage::helper('newsletter')->__('Sender Name'),
            'title'     => Mage::helper('newsletter')->__('Sender Name'),
            'required'  => true,
            'value'     => $queue->getTemplate()->getTemplateSenderName()
        ));

        $fieldset->addField('sender_email', 'text', array(
            'name'      =>'sender_email',
            'label'     => Mage::helper('newsletter')->__('Sender Email'),
            'title'     => Mage::helper('newsletter')->__('Sender Email'),
            'class'     => 'validate-email',
            'required'  => true,
            'value'     => $queue->getTemplate()->getTemplateSenderEmail()
        ));

        if (in_array($queue->getQueueStatus(), array(
                Mage_Newsletter_Model_Queue::STATUS_NEVER,
                Mage_Newsletter_Model_Queue::STATUS_PAUSE))) {

            $widgetFilters = array('is_email_compatible' => 1);
            $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('widget_filters' => $widgetFilters));
            if ($queue->getTemplate()->isPlain()) {
                $wysiwygConfig->setEnabled(false);
            }
            $fieldset->addField('text','editor', array(
                'name'      => 'text',
                'label'     => Mage::helper('newsletter')->__('Message'),
                'state'     => 'html',
                'required'  => true,
                'value'     => $queue->getTemplate()->getTemplateText(),
                'style'     => 'width:98%; height: 600px;',
                'config'    => $wysiwygConfig
            ));
        } else {
            $fieldset->addField('text','text', array(
                'name'      =>    'text',
                'label'     =>    Mage::helper('newsletter')->__('Message'),
                'value'     =>    $this->getUrl('*/newsletter_template/preview',  array(
                                     'id' => $queue->getTemplate()->getId()
                                  ))
            ));


        

            $form->getElement('text')->setRenderer(Mage::getModel('adminhtml/newsletter_renderer_text'));
            $form->getElement('subject')->setDisabled('true');
            $form->getElement('sender_name')->setDisabled('true');
            $form->getElement('sender_email')->setDisabled('true');
            $form->getElement('stores')->setDisabled('true');
        }

        $this->setForm($form);
        return parent::_prepareForm();
    }
}// Class Mage_Adminhtml_Block_Newsletter_Queue_Edit_Form END
