<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class SettingTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'id' => $this->when($this->id, $this->id),
        'name' => $this->when($this->name, $this->name),
        'value' => $this->when($this->value, $this->value),
        'store' => new StoreTransformer($this->whenLoaded('store')),
    ];


    return $data;

  }
}
