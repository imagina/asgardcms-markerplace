<?php

namespace Modules\Marketplace\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Modules\Marketplace\Events\StoreWasCreated;
use Modules\Marketplace\Events\FavoriteStoreWasCreated;
use Modules\Marketplace\Events\Handlers\FavoriteStore;
use Modules\Marketplace\Events\Handlers\CreatePollStore;
use Modules\Marketplace\Events\Handlers\CreatePositionStore;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FavoriteStoreWasCreated::class => [
           FavoriteStore::class
        ],
        StoreWasCreated::class => [
           CreatePollStore::class,
           CreatePositionStore::class
        ],

    ];
}
