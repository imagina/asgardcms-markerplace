<?php

namespace Modules\Marketplace\Events\Handlers;


use Modules\Notification\Services\Notification;

class FavoriteStore
{
    private $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function handle($event)
    {
        $store=$event->entity->store;
        $user=$event->entity->user;
        $this->notification->to($store->user_id)->push('Nuevo suscriptor', $user->present()->fullName()." está siguiendo su tienda ".$store->name,'fas fa-users', '/admin/followers/index');
    }


}
