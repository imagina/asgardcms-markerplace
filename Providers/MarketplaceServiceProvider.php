<?php

namespace Modules\Marketplace\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Marketplace\Events\Handlers\RegisterMarketplaceSidebar;
use Modules\Marketplace\Repositories\StoreHistoryRepository;
use Modules\Marketplace\Services\StoreHistory;
use Modules\User\Contracts\Authentication;

class MarketplaceServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterMarketplaceSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('settings', array_dot(trans('marketplace::settings')));
            $event->load('stores', array_dot(trans('marketplace::stores')));
            $event->load('storehistories', array_dot(trans('marketplace::storehistories')));
            $event->load('themes', array_dot(trans('marketplace::themes')));
            $event->load('comments', array_dot(trans('marketplace::comments')));
            $event->load('categorystores', array_dot(trans('marketplace::categorystores')));
            // append translations






        });
    }

    public function boot()
    {
        $this->publishConfig('marketplace', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Marketplace\Repositories\SettingRepository',
            function () {
                $repository = new \Modules\Marketplace\Repositories\Eloquent\EloquentSettingRepository(new \Modules\Marketplace\Entities\Setting());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Marketplace\Repositories\Cache\CacheSettingDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Marketplace\Repositories\StoreRepository',
            function () {
                $repository = new \Modules\Marketplace\Repositories\Eloquent\EloquentStoreRepository(new \Modules\Marketplace\Entities\Store());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Marketplace\Repositories\Cache\CacheStoreDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Marketplace\Repositories\StoreHistoryRepository',
            function () {
                $repository = new \Modules\Marketplace\Repositories\Eloquent\EloquentStoreHistoryRepository(new \Modules\Marketplace\Entities\StoreHistory());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Marketplace\Repositories\Cache\CacheStoreHistoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Marketplace\Repositories\ThemesRepository',
            function () {
                $repository = new \Modules\Marketplace\Repositories\Eloquent\EloquentThemesRepository(new \Modules\Marketplace\Entities\Themes());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Marketplace\Repositories\Cache\CacheThemesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Marketplace\Repositories\CommentRepository',
            function () {
                $repository = new \Modules\Marketplace\Repositories\Eloquent\EloquentCommentRepository(new \Modules\Marketplace\Entities\Comment());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Marketplace\Repositories\Cache\CacheCommentDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Marketplace\Repositories\CategoryStoreRepository',
            function () {
                $repository = new \Modules\Marketplace\Repositories\Eloquent\EloquentCategoryStoreRepository(new \Modules\Marketplace\Entities\CategoryStore());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Marketplace\Repositories\Cache\CacheCategoryStoreDecorator($repository);
            }
        );

        $this->app->bind(\Modules\Marketplace\Services\History::class, function ($app) {
            return new StoreHistory($app[StoreHistoryRepository::class], $app[Authentication::class]);
        });
    }
}
