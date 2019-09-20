<?php

namespace Modules\Marketplace\Events;

use Modules\Marketplace\Entities\Store;
use Modules\Media\Contracts\StoringMedia;

class StoreWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Store
     */
    public $store;

    public function __construct(Store $store, array $data)
    {
        $this->data = $data;
        $this->store = $store;
    }

    /**
     * Return the entity
     * @return Store
     */
    public function getEntity()
    {
        return $this->store;
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
