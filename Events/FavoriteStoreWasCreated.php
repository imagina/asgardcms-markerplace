<?php

namespace Modules\Marketplace\Events;

use Modules\Marketplace\Entities\Store;


class FavoriteStoreWasCreated
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Category
     */
    public $entity;

    public function __construct($store, array $data)
    {
        $this->data = $data;
        $this->entity = $store;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
