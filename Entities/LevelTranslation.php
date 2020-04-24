<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class LevelTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description'];
    protected $table = 'marketplace__level_translations';
}
