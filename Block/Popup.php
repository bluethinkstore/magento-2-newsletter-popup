<?php
/**
 * Copyright © Bluethink All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bluethinkinc\NewsletterPopup\Block;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Widget\Block\BlockInterface;
use Bluethinkinc\NewsletterPopup\Helper\Data as HelperData;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Customer\Model\Session;

class Popup extends AbstractProduct implements BlockInterface
{
    /**
     * @var HelperData
     */
    protected $_helperData;

    /** @var Session */
    protected $_customerSession;

    /** @var CookieManagerInterface */
    protected $_cookieManager;

    /**
     * Popup constructor.
     *
     * @param Context $context
     * @param HelperData $helperData
     * @param CookieManagerInterface $cookieManager
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Context $context,
        HelperData $helperData,
        CookieManagerInterface $cookieManager,
        Session $customerSession,
        array $data = []
    ) {
        $this->_helperData                  = $helperData;
        $this->_cookieManager = $cookieManager;
        $this->_customerSession = $customerSession;

        parent::__construct($context, $data);
    }

    /**
     * Get popup HTML
     */
    public function getContentHtml()
    {
        $htmlConfig = $this->_helperData->getContentHtml();
        $image = $this->_helperData->getNewsletterImage();
        if ($image==null) {
            $image = $this->getViewFileUrl('Bluethinkinc_NewsletterPopup::images/mail-icon.png');
        } else {
            $image = $this->getBaseUrl().'media/newsletter/'.$image;
        }
        
        $search  = [
            '{{form_url}}',
            '{{image_url}}'
        ];
        $replace = [
            $this->getFormActionUrl(),
            $image
        ];

        return str_replace($search, $replace, $htmlConfig);
    }

    /**
     * Get Url NewAction Newsletter
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('newsletterpopup/subscriber/new', ['_secure' => true]);
    }

    /**
     * Get popup Height
     */
    public function getHeightPopup()
    {
        return $this->_helperData->getHeightPopup();
    }

    /**
     * Get popup Background Color
     */
    public function getBackgroundColor()
    {
        return $this->_helperData->getBackgroundColor();
    }

    /**
     * Get popup Text Color
     */
    public function getTextColor()
    {
        return $this->_helperData->getTextColor();
    }

    /**
     * Get popup Width
     */
    public function getWidthPopup()
    {
        return $this->_helperData->getWidthPopup();
    }

    /**
     * Check to show popup HTML
     */
    public function showPage()
    {
        if ($this->_customerSession->isLoggedIn()) {
            return false;
        }
        // check cookies
        $cookieValue = $this->_cookieManager->getCookie('appear_again_newsletter');
        if (isset($cookieValue)) {
            $appear_date = $cookieValue;
            $appear_date = trim(preg_replace('/\s*\([^)]*\)/', '', $appear_date));
            $appear_date = strtotime($appear_date);
            $current_date = strtotime(date('Y-m-d H:i:s'));
            if ($appear_date > $current_date) {
                return false;
            }
        }
        if ($this->_helperData->checkPageType()==1) {
            return ($this->checkIncludePages());
        } elseif ($this->_helperData->checkPageType()==2) {
            return ($this->checkExcludePages());
        }
    }

    /**
     * Check Include pages for popup
     */
    public function checkIncludePages()
    {
        $action = $this->getRequest()->getFullActionName();
        $currentPath = $this->getRequest()->getRequestUri();
        $configIncludePages = $this->_helperData->checkIncludePages();
        if ($configIncludePages) {
            $includePages = explode("\n", $configIncludePages);
            $pages   = array_map('trim', $includePages);
            foreach ($pages as $page) {
                if ($page && strpos($currentPath, $page) !== false) {
                    return true;
                } elseif ($page && strpos($action, $page) !== false) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Check Exclude pages for popup
     */
    public function checkExcludePages()
    {
        $action = $this->getRequest()->getFullActionName();
        $currentPath = $this->getRequest()->getRequestUri();
        $configIncludePages = $this->_helperData->checkExcludePages();
        if ($configIncludePages) {
            $includePages = explode("\n", $configIncludePages);
            $pages   = array_map('trim', $includePages);
            foreach ($pages as $page) {
                if ($page && strpos($currentPath, $page) !== false) {
                    return false;
                } elseif ($page && strpos($action, $page) !== false) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Check X second for popup delay
     */
    public function getAfterSecond()
    {
        return $this->_helperData->getAfterSecond();
    }

    /**
     * Check When popup will show again
     */
    public function checkAppearAgain()
    {
        $appear = $this->_helperData->checkAppearAgain();
        if ($appear) {
            return $appear;
        } else {
            return 1;
        }
    }
}
