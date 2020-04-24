<?php

namespace Modules\Marketplace\Events;

use Modules\Media\Contracts\DeletingMedia;

class ThemeWasDeleted implements DeletingMedia
{

    /**
     * @var categoryClass
     */
    public $categoryClass;

    /**
     * @var categoryId
     */
    public $categoryId;

    public function __construct($categoryId,$categoryClass)
    {
        $this->categoryClass = $categoryClass;
        $this->categoryId = $categoryId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->categoryId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->categoryClass;
    }
}
