<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Activitystream
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


/**
 * 
 */
class AW_Activitystream_Model_AdminhtmlSystemConfigSourceStorefilter {
    
    /**
     * 
     */
    public function toOptionArray() {
        $__H = Mage::helper('activitystream');
        
        return array(
            array(
                'label' => $__H->__('Current store view'),
                'value' => AW_Activitystream_Helper_Data::STREAM_STOREFILTER_STOREVIEW
            ),
            array(
                'label' => $__H->__('Current store'),
                'value' => AW_Activitystream_Helper_Data::STREAM_STOREFILTER_STORE
            ),
            array(
                'label' => $__H->__('Current website'),
                'value' => AW_Activitystream_Helper_Data::STREAM_STOREFILTER_WEBSITE
            ),
            array(
                'label' => $__H->__('Display all'),
                'value' => AW_Activitystream_Helper_Data::STREAM_STOREFILTER_DISPLAYALL
            )
        );
    }
}