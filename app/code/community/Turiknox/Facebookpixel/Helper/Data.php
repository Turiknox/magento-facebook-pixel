<?php
/*
 * Turiknox_Facebookpixel

 * @category   Turiknox
 * @package    Turiknox_Facebookpixel
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-facebook-pixel/blob/master/LICENSE.md
 * @version    1.1.1
 */
class Turiknox_Facebookpixel_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Check module has been enabled in the admin
     *
     * @return bool
     */
    public function isModuleEnabledInAdmin()
    {
        return Mage::getStoreConfigFlag('facebookpixel/integration/enable');
    }
}