<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\View\Layout;

use Magento\Framework\View\LayoutInterface;

/**
 * Interface BuilderInterface
 */
interface BuilderInterface
{
    /**
     * Build structure
     *
     * @return LayoutInterface
     */
    public function build();
}
