<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class LevelCriteriaTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = 'marketplace__levelcriteria_translations';
}
