<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class BenefitsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description'];
    protected $table = 'marketplace__benefits_translations';
}
