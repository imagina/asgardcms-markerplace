<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class StoreContact extends Model
{

    protected $table = 'marketplace__storecontacts';
    protected $fillable = [
      "full_name",
      "subject",
      "email",
      "phone",
      "store_id",
      "message"
    ];


        public function store()
        {
            return $this->belongsTo(Store::class);
        }


}
