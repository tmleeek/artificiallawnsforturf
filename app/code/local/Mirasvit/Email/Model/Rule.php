<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Follow Up Email
 * @version   1.0.2
 * @revision  269
 * @copyright Copyright (C) 2014 Mirasvit (http://mirasvit.com/)
 */


class Mirasvit_Email_Model_Rule extends Mage_Rule_Model_Rule
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('email/rule');
        $this->setIdFieldName('rule_id');
    }

    public function getConditionsInstance()
    {
        return Mage::getModel('email/rule_condition_combine');
    }

    public function getActionsInstance()
    {
        return Mage::getModel('email/rule_action_collection');
    }

    public function _resetConditions($conditions = null)
    {
        if (is_null($conditions)) {
            $conditions = $this->getConditionsInstance();
        }
        $conditions->setRule($this)->setId($this->getType().'_1')->setPrefix('conditions');
        $this->setConditions($conditions);

        return $this;
    }

    public function validate(Varien_Object $object)
    {
        // if ($object->hasData('customer')) {
        //     $customer = $object->getData('customer');

        //     $object->setData('customer_group_id', $customer->getGroupId());

        //     $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($customer->getEmail());
        //     $object->setData('is_subscriber', $subscriber->getId() ? 1 : 0);

        //     $reviews = Mage::getModel('review/review')->getCollection()
        //         ->addFieldToFilter('customer_id', $customer->getId());
        //     $object->setData('reviews_count', $reviews->count());


        //     $customerTotals = Mage::getResourceModel('sales/sale_collection')
        //         ->setCustomerFilter($customer)
        //         ->setOrderStateFilter(Mage_Sales_Model_Order::STATE_CANCELED, true)
        //         ->load()
        //         ->getTotals();
        //     $object->setData('sales_amount', $customerTotals['lifetime']);
        // } else {
        //     $object->setData('customer_group_id', 0);
        // }

        // if ($object->hasData('quote')) {
        //     $quote = $object->getData('quote');
        //     $totals = $quote->getTotals();
        //     $object->setData('quote_grand_total', $totals['grand_total']->getValue());
        //     $object->setData('quote_items_summary_qty', $quote->getItemsSummaryQty());

        //     $skus = array();
        //     foreach ($quote->getItemsCollection() as $item) {
        //         $skus[] = $item->getProduct()->getSku();
        //     }

        //     $object->setData('sku', $skus);
        // }

        // if ($object->hasData('order')) {
        //     $order = $object->getData('order');

        //     $qty   = 0;
        //     $skus  = array();
        //     foreach ($order->getAllItems() as $item) {
        //         $skus[] = $item->getProduct()->getSku();
        //         $qty += $item->getQtyOrdered();
        //     }

        //     $object->setData('sku', $skus);
        //     $object->setData('order_grand_total', $order->getGrandTotal());
        //     $object->setData('order_items_summary_qty', $qty);
        // }

        return parent::validate($object);
    }

    public function toString($format = '')
    {
        $string = $this->getConditions()->asStringRecursive();

        $string = nl2br(preg_replace('/ /', '&nbsp;', $string));

        return $string;
    }
}