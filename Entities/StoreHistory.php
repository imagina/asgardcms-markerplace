<?php

namespace Modules\Marketplace\Entities;


use Illuminate\Database\Eloquent\Model;

class StoreHistory extends Model
{

    protected $table = 'marketplace__storehistories';
    protected $fillable = ['store_id', 'user_id', 'ip', 'change'];


    public function user()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
