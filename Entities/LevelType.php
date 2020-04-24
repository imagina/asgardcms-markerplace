<?php

namespace Modules\Marketplace\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class LevelType extends Model
{
    use Translatable;

    protected $table = 'marketplace__leveltypes';
    public $translatedAttributes = ['name'];
    protected $fillable = ['entity_namespace'];
}
