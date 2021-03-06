<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\UrlRewrite\Model;

/**
 * Url Persist Interface
 */
interface UrlPersistInterface
{
    /**
     * Save new url rewrites and remove old if exist
     *
     * @param \Magento\UrlRewrite\Service\V1\Data\UrlRewrite[] $urls
     * @return void
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function replace(array $urls);

    /**
     * Remove rewrites that contains some rewrites data
     *
     * @param array $data
     * @return void
     * @api
     */
    public function deleteByData(array $data);
}
