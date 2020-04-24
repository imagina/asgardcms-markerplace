<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class FavoriteStore extends Model
{
    
    protected $table = 'marketplace__favoritestores';
    protected $fillable = [
        'store_id',
        'user_id'
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User")->with('fields');
    }


}
