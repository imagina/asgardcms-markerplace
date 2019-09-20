<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class ThemesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description'];
    protected $table = 'marketplace__themes_translations';
}
