<?php

namespace Modules\Marketplace\Events\Handlers;


use Modules\Iquiz\Entities\Poll;

class CreatePollStore
{

    public function __construct()
    {

    }

    public function handle($event)
    {
        $store = $event->entity;

        Poll::create([
          "title"=>$store->name,
          "description"=>"Encuestas para la tienda: ".$store->name,
          "start_date"=>\Carbon\Carbon::now()->format('Y-m-d'),
          "end_date"=>\Carbon\Carbon::now()->addYears(5)->format('Y-m-d'),
          "status"=>1,
          "system_name"=>"home-".$store->id,
          "logged"=>1,
          "store_id"=>$store->id
        ]);

    }



}
