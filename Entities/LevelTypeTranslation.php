<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class LevelTypeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = 'marketplace__leveltype_translations';
}
