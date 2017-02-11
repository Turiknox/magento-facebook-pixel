<?php
/*
 * Turiknox_Facebookpixel

 * @category   Turiknox
 * @package    Turiknox_Facebookpixel
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-facebook-pixel/blob/master/LICENSE.md
 * @version    1.1.1
 */
class Turiknox_Facebookpixel_Model_System_Config_Source_Events
{
    /**
     * Return array of events to track
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'search', 'label' => Mage::helper('core')->__('Search')),
            array('value' => 'add_to_cart', 'label' => Mage::helper('core')->__('AddToCart')),
            array('value' => 'add_to_wishlist', 'label' => Mage::helper('core')->__('AddToWishlist')),
            array('value' => 'initiate_checkout', 'label' => Mage::helper('core')->__('InitiateCheckout')),
            array('value' => 'purchase', 'label' => Mage::helper('core')->__('Purchase')),
            array('value' => 'complete_registration', 'label' => Mage::helper('core')->__('CompleteRegistration'))
        );
    }
}