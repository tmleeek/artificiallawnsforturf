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


class Mirasvit_EmailDesign_Helper_Variables_Order
{
    public function getOrder($parent, $args)
    {
        $order = false;

        if ($parent->getData('order')) {
            return $parent->getData('order');
        } elseif ($parent->getData('order_id')) {
            $order = Mage::getModel('sales/order')->load($parent->getData('order_id'));
        }

        $parent->setData('order', $order);

        return $order;
    }
}