<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iprofile\Transformers\UserTransformer;

class FavoriteStoreTransformer extends Resource
{
  public function toArray($request)
  {
    
    $data = [
        'id' => $this->when($this->id, $this->id),
        'storeId' => $this->when($this->store_id, $this->store_id),
        'store' => new StoreTransformer($this->whenLoaded('store')),
        'userId' => $this->when($this->user_id, $this->user_id),
        'user' => new UserTransformer($this->whenLoaded('user')),
        'createdAt' => $this->when($this->created_at,$this->created_at),
        'updatedAt' => $this->when($this->updated_at,$this->updated_at)
    ];

    return $data;

  }
}
