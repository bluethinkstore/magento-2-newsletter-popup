<?php
/**
 * Copyright © Bluethink All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bluethinkinc\NewsletterPopup\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Appear implements ArrayInterface
{
    public const AFTER_PAGE_LOADED = 1;
    public const AFTER_X_SECONDS = 2;

    /**
     * Set options for newsletter popup
     */
    public function toOptionArray()
    {
        $options = [];
        $options[] = [
            'value' => self::AFTER_PAGE_LOADED,
            'label' => __('After page loaded'),
        ];
        $options[] = [
            'value' => self::AFTER_X_SECONDS,
            'label' =>  __('After X seconds'),
        ];

        return $options;
    }
}
