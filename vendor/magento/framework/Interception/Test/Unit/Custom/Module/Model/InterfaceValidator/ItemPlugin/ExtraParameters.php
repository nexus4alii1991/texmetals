<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace Magento\Framework\Interception\Test\Unit\Custom\Module\Model\InterfaceValidator\ItemPlugin;

class ExtraParameters
{
    /**
     * @param \Magento\Framework\Interception\Test\Unit\Custom\Module\Model\InterfaceValidator\Item $subject
     * @param string $name
     * @param string $surname
     * @return string
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetItem(
        \Magento\Framework\Interception\Test\Unit\Custom\Module\Model\InterfaceValidator\Item $subject, $name, $surname
    ) {
        return $name . $surname;
    }
}
