<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Store\Api;

/**
 * @api
 */
interface StoreManagementInterface
{
    /**
     * Provide the number of store count
     *
     * @return int
     */
    public function getCount();
}
