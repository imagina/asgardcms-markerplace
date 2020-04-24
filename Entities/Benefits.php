<?php

namespace Modules\Marketplace\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Benefits extends Model
{
    use Translatable;

    protected $table = 'marketplace__benefits';
    public $translatedAttributes = ['name','description'];
    protected $fillable = ['system_name'];
}
