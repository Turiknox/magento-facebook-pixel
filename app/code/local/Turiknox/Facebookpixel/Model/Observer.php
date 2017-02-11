<?php
/*
 * Turiknox_Facebookpixel

 * @category   Turiknox
 * @package    Turiknox_Facebookpixel
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento-facebook-pixel/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_Facebookpixel_Model_Observer
{
    /**
     * Set data when product has been added to the cart
     *
     * @param $observer
     * @return $this
     */
    public function setAddToCart($observer)
    {
        $product = $observer->getProduct();

        $addToCartData = array();
        $addToCartData['content_type'] = 'product';
        $addToCartData['content_ids'] = $product->getSku();
        $addToCartData['content_name'] = $product->getName();
        $addToCartData['value'] = $product->getFinalPrice();
        $addToCartData['currency'] = Mage::app()->getStore()->getCurrentCurrencyCode();

        Mage::getSingleton('core/session')->setData('fb_addtocart', $addToCartData);
        return $this;
    }

    /**
     * Set data when product has been added to the wishlist
     *
     * @param $observer
     * @return $this
     */
    public function setAddToWishlist($observer)
    {
        $product = $observer->getProduct();

        $addToWishlistData = array();
        $addToWishlistData['content_type'] = 'product';
        $addToWishlistData['content_ids'] = $product->getSku();
        $addToWishlistData['content_name'] = $product->getName();
        $addToWishlistData['value'] = $product->getFinalPrice();
        $addToWishlistData['currency'] = Mage::app()->getStore()->getCurrentCurrencyCode();

        Mage::getSingleton('core/session')->setData('fb_addtowishlist', $addToWishlistData);
        return $this;
    }

    /**
     * Set data when customer has registered to store
     *
     * @param $observer
     * @return $this
     */
    public function setCompleteRegistration($observer)
    {
        $customer = $observer->getCustomer();

        $confirmation = 'not_confirmed';
        if (!$customer->getConfirmation()) {
            $confirmation = 'confirmed';
        }

        $completeRegistrationData = array();
        $completeRegistrationData['status'] = $confirmation;

        Mage::getSingleton('core/session')->setData('fb_completeregistration', $completeRegistrationData);
        return $this;
    }

    /**
     * Set data when customer goes to the onepage checkout page
     *
     * @return $this
     */
    public function setInitiateCheckout()
    {
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $numItems = $quote->getAllVisibleItems();

        $itemSkus = array();
        foreach ($numItems as $item) {
            $itemSkus[] = htmlspecialchars($item->getSku());
        }

        $initiateCheckoutData = array();
        $initiateCheckoutData['value'] = number_format($quote->getSubtotal(), 2);
        $initiateCheckoutData['num_items'] = count($numItems);
        $initiateCheckoutData['currency'] = Mage::app()->getStore()->getCurrentCurrencyCode();
        $initiateCheckoutData['content_type'] = 'product';
        $initiateCheckoutData['content_ids'] = $itemSkus;

        Mage::getSingleton('core/session')->setData('fb_initiatecheckout', $initiateCheckoutData);
        return $this;
    }

    /**
     * If One Step Checkout is enabled, head to initiateCheckout()
     *
     * @return $this
     */
    public function setInitiateIdevOsc()
    {
        if ($this->isCheckoutModuleEnabled('Idev_OneStepCheckout')) {
            // Additional check if the module is enabled in the admin
            if (Mage::helper('onestepcheckout')->isRewriteCheckoutLinksEnabled()) {
                $this->setInitiateCheckout();
            }
        }
        return $this;
    }

    /**
     * If IWD One Page Checkout is enabled, head to initiateCheckout()
     *
     * @return $this
     */
    public function setInitiateIwdOpc()
    {
        if ($this->isCheckoutModuleEnabled('IWD_Opc')) {
            // Additional check if the module is enabled in the admin
            if (Mage::helper('opc')->isEnable()) {
                $this->setInitiateCheckout();
            }
        }
        return $this;
    }

    /**
     * Check if the checkout module is enabled in XML
     *
     * @param $module
     * @return boolean
     */
    public function isCheckoutModuleEnabled($module)
    {
        return Mage::getConfig()->getModuleConfig($module)->is('active', 'true');
    }

    /**
     * Set purchase data when customer places an order
     *
     * @param $observer
     * @return $this
     */
    public function setPurchase($observer)
    {
        $order = $observer->getOrder();
        $numItems = $order->getAllVisibleItems();

        $itemSkus = array();
        foreach ($numItems as $item) {
            $itemSkus[] = htmlspecialchars($item->getSku());
        }

        $purchaseData = array();
        $purchaseData['value'] = number_format($order->getGrandTotal(), 2);
        $purchaseData['num_items'] = count($numItems);
        $purchaseData['currency'] = Mage::app()->getStore()->getCurrentCurrencyCode();
        $purchaseData['content_type'] = 'product';
        $purchaseData['content_ids'] = $itemSkus;

        Mage::getSingleton('core/session')->setData('fb_purchase', $purchaseData);
        return $this;
    }
}