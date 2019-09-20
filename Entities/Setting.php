<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'marketplace__settings';
    protected $fillable = ['name','value','store_id'];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
