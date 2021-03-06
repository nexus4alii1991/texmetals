<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Swatches\Model;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Select;

/**
 * Class SwatchAttributeCodes for getting codes of swatch attributes.
 */
class SwatchAttributeCodes
{
    /**
     * @var string
     */
    private $cacheKey;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @var array
     */
    private $swatchAttributeCodes;

    /**
     * @var array
     */
    private $cacheTags;

    /**
     * SwatchAttributeList constructor.
     *
     * @param CacheInterface $cache
     * @param ResourceConnection $resourceConnection
     * @param string $cacheKey
     * @param array $cacheTags
     */
    public function __construct(
        CacheInterface $cache,
        ResourceConnection $resourceConnection,
        $cacheKey,
        array $cacheTags
    ) {
        $this->cache = $cache;
        $this->resourceConnection = $resourceConnection;
        $this->cacheKey = $cacheKey;
        $this->cacheTags = $cacheTags;
    }

    /**
     * Returns list of known swatch attribute codes. Check cache and database.
     *
     * @return array
     */
    public function getCodes()
    {
        if ($this->swatchAttributeCodes === null) {
            $swatchAttributeCodesCache = $this->cache->load($this->cacheKey);
            if (false === $swatchAttributeCodesCache) {
                $swatchAttributeCodes = $this->loadSwatchAttributeCodes();
                $this->cache->save(json_encode($swatchAttributeCodes), $this->cacheKey, $this->cacheTags);
            } else {
                $swatchAttributeCodes = json_decode($swatchAttributeCodesCache, true);
            }
            $this->swatchAttributeCodes = $swatchAttributeCodes;
        }

        return $this->swatchAttributeCodes;
    }

    /**
     * Returns list of known swatch attributes.
     *
     * @return array
     */
    private function loadSwatchAttributeCodes()
    {
        $select = $this->resourceConnection->getConnection()->select()
            ->from(
                ['a' => $this->resourceConnection->getTableName('eav_attribute')],
                [
                    'attribute_id' => 'a.attribute_id',
                    'attribute_code' => 'a.attribute_code',
                ]
            )->where(
                'a.attribute_id IN (?)',
                new \Zend_Db_Expr(sprintf('(%s)', $this->getAttributeIdsSelect()))
            );
        $result = $this->resourceConnection->getConnection()->fetchPairs($select);
        return $result;
    }

    /**
     * Returns Select for attributes Ids.
     *
     * @return Select
     */
    private function getAttributeIdsSelect()
    {
        return $this->resourceConnection->getConnection()->select()
            ->from(
                ['o' => $this->resourceConnection->getTableName('eav_attribute_option')],
                ['attribute_id' => 'o.attribute_id']
            )->join(
                ['s' => $this->resourceConnection->getTableName('eav_attribute_option_swatch')],
                'o.option_id = s.option_id',
                []
            );
    }
}
