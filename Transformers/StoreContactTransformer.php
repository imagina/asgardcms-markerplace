<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;
use Modules\Ihelpers\Transformers\BaseApiTransformer;

class StoreContactTransformer extends BaseApiTransformer
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->when($this->id, $this->id),
            'fullName' => $this->when($this->full_name, $this->full_name),
            'subject' => $this->when($this->subject, $this->subject),
            'email' => $this->when($this->email, $this->email),
            'phone' => $this->when($this->phone, $this->phone),
            'message' => $this->when($this->message, $this->message),
            'createdAt' => $this->when($this->created_at, $this->created_at),
            'updatedAt' => $this->when($this->updated_at, $this->updated_at),
        ];

        return $data;

    }
}
