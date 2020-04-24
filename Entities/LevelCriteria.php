<?php

namespace Modules\Marketplace\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class LevelCriteria extends Model
{
    use Translatable;

    protected $table = 'marketplace__levelcriterias';
    public $translatedAttributes = ['name'];
    protected $fillable = [
      'level_type_id',
      'type',
      'relation_name',
      'operator',
      'options',
    ];

    public function levelType()
    {
        return $this->belongsTo('Modules\Marketplace\Entities\LevelType', 'level_type_id');
    }

}
