<?php
/**
 * Copyright © Bluethink All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bluethinkinc\NewsletterPopup\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class PageToShow implements ArrayInterface
{
    public const SPECIFIC_PAGES = 1;
    public const ALL_PAGES = 2;

    /**
     * Return array of options as value-label pairs
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::SPECIFIC_PAGES, 'label' => __('Specific pages')],
            ['value' => self::ALL_PAGES, 'label' => __('All Pages')]
        ];
    }
}
