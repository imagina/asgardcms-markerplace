<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;
use Illuminate\Support\Arr;

class StoreHistoryTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'id' => $this->when($this->id, $this->id),
        'IP' => $this->when($this->ip, $this->ip),
        'change' => $this->when($this->change, $this->change),
        'store' => new StoreTransformer($this->whenLoaded('store')),
        'user' => new UserProfileTransformer($this->whenLoaded('user')),
    ];


    return $data;

  }
}
