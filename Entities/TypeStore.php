<?php

namespace Modules\Marketplace\Entities;

/**
 * Class Status
 * @package Modules\Blog\Entities
 */
class TypeStore
{
    const STORE = 0;
    const INDEPENDENT = 1;
    const DIRECTORY = 2;
    const FREE = 3;

    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::STORE => trans('marketplace::common.typeStore.store'),
            self::INDEPENDENT => trans('marketplace::common.typeStore.independent'),
            self::DIRECTORY => trans('marketplace::common.typeStore.directory'),
            self::FREE => trans('marketplace::common.typeStore.free'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::STORE];
    }
}
