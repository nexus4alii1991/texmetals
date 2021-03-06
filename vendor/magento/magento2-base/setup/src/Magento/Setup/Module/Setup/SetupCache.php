<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Setup\Module\Setup;

use Magento\Framework\Setup\DataCacheInterface;

/**
 * In-memory cache of DB data
 */
class SetupCache implements DataCacheInterface
{
    /**
     * Cache storage
     *
     * @var array
     */
    private $data = [];

    /**
     * {@inheritdoc}
     */
    public function setRow($table, $parentId, $rowId, $value)
    {
        $this->data[$table][$parentId][$rowId] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function setField($table, $parentId, $rowId, $field, $value)
    {
        $this->data[$table][$parentId][$rowId][$field] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function get($table, $parentId, $rowId, $field = null)
    {
        if (null === $field) {
            return isset($this->data[$table][$parentId][$rowId]) ?
                $this->data[$table][$parentId][$rowId] :
                false;
        } else {
            return isset($this->data[$table][$parentId][$rowId][$field]) ?
                $this->data[$table][$parentId][$rowId][$field] :
                false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function remove($table, $parentId, $rowId)
    {
        if (isset($this->data[$table][$parentId][$rowId])) {
            unset($this->data[$table][$parentId][$rowId]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function has($table, $parentId, $rowId, $field = null)
    {
        if (null === $field) {
            return !empty($this->data[$table][$parentId][$rowId]);
        } else {
            return !empty($this->data[$table][$parentId][$rowId][$field]);
        }
    }
}
