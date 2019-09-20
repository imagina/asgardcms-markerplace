<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryStoreTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'marketplace__categorystore_translations';
}
