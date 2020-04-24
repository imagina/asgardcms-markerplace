<?php

namespace Modules\Marketplace\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
  use Translatable;

  protected $table = 'marketplace__levels';
  public $translatedAttributes = ['name','description'];
  protected $fillable = [
    'order',
    'level_type_id',
    'options',
  ];

  protected $casts = [
    'options' => 'array',
  ];

  public function levelType()
  {
      return $this->belongsTo('Modules\Marketplace\Entities\LevelType', 'level_type_id');
  }

  public function getOptionsAttribute($value)
  {
    try {
      return json_decode(json_decode($value));
    } catch (\Exception $e) {
      return json_decode($value);
    }
  }
}
