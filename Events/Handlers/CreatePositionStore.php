<?php

namespace Modules\Marketplace\Events\Handlers;


use Modules\Ibanners\Entities\Position;

class CreatePositionStore
{

    public function __construct()
    {

    }

    public function handle($event)
    {
        $store = $event->entity;

        Position::create([
          "name"=>$store->name,
          "active"=>1,
          "system_name"=>"home-".$store->id,
          "store_id"=>$store->id
        ]);

    }



}
