<?php

namespace Modules\Marketplace\Events;

use Modules\Marketplace\Entities\Themes;
use Modules\Media\Contracts\StoringMedia;

class ThemeWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Category
     */
    public $category;

    public function __construct(Themes $category, array $data)
    {
        $this->data = $data;
        $this->category = $category;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->category;
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
