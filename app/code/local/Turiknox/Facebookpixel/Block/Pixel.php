<?php
/*
 * Turiknox_Facebookpixel

 * @category   Turiknox
 * @package    Turiknox_Facebookpixel
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento-facebook-pixel/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_Facebookpixel_Block_Pixel extends Mage_Core_Block_Template
{
    /**
     * Get the Facebook Pixel ID
     *
     * @return string
     */
    public function getFacebookPixelId()
    {
        return Mage::getStoreConfig('facebookpixel/integration/pixelid');
    }

    /**
     * Get the Facebook Product Catalog ID
     *
     * @return int
     */
    public function getProductCatalogId()
    {
        return Mage::getStoreConfig('facebookpixel/integration/catalogid');
    }

    /**
     * Check if event should be tracked
     *
     * @param $event
     * @return bool
     */
    public function isEventAllowed($event)
    {
        $_events = explode(',', Mage::getStoreConfig('facebookpixel/integration/events'));

        foreach ($_events as $_event) {
            if ($event === $_event) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the search query string
     *
     * @return string
     */
    public function getSearchQuery()
    {
        $request = $this->getRequest();
        if ($query = $request->getParam('name')) {
            return $query;
        } else {
            return $request->getParam('q');
        }
    }
}