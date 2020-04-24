<?php

namespace Modules\Marketplace\Events;

use Modules\Marketplace\Entities\Themes;
use Modules\Media\Contracts\StoringMedia;

class ThemeWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Category
     */
    public $entity;

    public function __construct($category, array $data)
    {
        $this->data = $data;
        $this->entity = $category;
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
