<?php

namespace Modules\Marketplace\Events;

use Modules\Media\Contracts\DeletingMedia;

class StoreWasDeleted implements DeletingMedia
{

    /**
     * @var storeClass
     */
    public $storeClass;

    /**
     * @var storeId
     */
    public $storeId;

    public function __construct($storeId,$storeClass)
    {
        $this->storeClass = $storeClass;
        $this->storeId = $storeId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->storeId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->storeClass;
    }
}
