<?php
/**
 * Copyright © Bluethink All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bluethinkinc\NewsletterPopup\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public const CONFIG_MODULE_PATH = 'newsletterpopup';
    
    /**
     * Check faq module is enabled
     */
    public function getModuleEnabled()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/general/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }
    /**
     * Check faq module is enabled
     */
    public function getContentHtml()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/general/html_content',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }
    /**
     * Check faq module is enabled
     */
    public function getHeightPopup()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/general/height',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }

    /**
     * Check faq module is enabled
     */
    public function getBackgroundColor()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/general/background_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }

    /**
     * Check faq module is enabled
     */
    public function getTextColor()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/general/text_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }

    /**
     * Check faq module is enabled
     */
    public function getWidthPopup()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/general/width',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }

    /**
     * Check faq module is enabled
     */
    public function getNewsletterImage()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/general/newsletter_image',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }

    /**
     * Check faq module is enabled
     */
    public function checkPageType()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/newsletter_pages_on/newsletter_pages_to_show',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }
    /**
     * Check faq module is enabled
     */
    public function checkIncludePages()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/newsletter_pages_on/newsletter_pages_to_include',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }

    /**
     * Check faq module is enabled
     */
    public function checkExcludePages()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/newsletter_pages_on/newsletter_pages_to_exclude',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }

    /**
     * Check faq module is enabled
     */
    public function getAfterSecond()
    {
        $valueAppearConfig = $this->scopeConfig->getValue(
            'newsletterpopup/newsletter_pages_when/popup_appear',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
        if ($valueAppearConfig==2) {
            $valueFromConfig = $this->scopeConfig->getValue(
                'newsletterpopup/newsletter_pages_when/delay',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            );
            return ($valueFromConfig)?$valueFromConfig:0;
        } else {
            return 0;
        }
    }

    /**
     * Check faq module is enabled
     */
    public function checkAppearAgain()
    {
        return $valueFromConfig = $this->scopeConfig->getValue(
            'newsletterpopup/newsletter_pages_when/popup_appear_again_after',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }
}
