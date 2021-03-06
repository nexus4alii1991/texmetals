<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Api\Search;

use Magento\Framework\Api\SearchCriteriaInterface as BaseSearchCriteriaInterface;

interface SearchCriteriaInterface extends BaseSearchCriteriaInterface
{
    /**
     * @return string
     */
    public function getRequestName();

    /**
     * @param string $requestName
     * @return $this
     */
    public function setRequestName($requestName);
}
