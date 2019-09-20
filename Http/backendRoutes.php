<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/marketplace'], function (Router $router) {
    $router->bind('setting', function ($id) {
        return app('Modules\Marketplace\Repositories\SettingRepository')->find($id);
    });
    $router->get('settings', [
        'as' => 'admin.marketplace.setting.index',
        'uses' => 'SettingController@index',
        'middleware' => 'can:marketplace.settings.index'
    ]);
    $router->get('settings/create', [
        'as' => 'admin.marketplace.setting.create',
        'uses' => 'SettingController@create',
        'middleware' => 'can:marketplace.settings.create'
    ]);
    $router->post('settings', [
        'as' => 'admin.marketplace.setting.store',
        'uses' => 'SettingController@store',
        'middleware' => 'can:marketplace.settings.create'
    ]);
    $router->get('settings/{setting}/edit', [
        'as' => 'admin.marketplace.setting.edit',
        'uses' => 'SettingController@edit',
        'middleware' => 'can:marketplace.settings.edit'
    ]);
    $router->put('settings/{setting}', [
        'as' => 'admin.marketplace.setting.update',
        'uses' => 'SettingController@update',
        'middleware' => 'can:marketplace.settings.edit'
    ]);
    $router->delete('settings/{setting}', [
        'as' => 'admin.marketplace.setting.destroy',
        'uses' => 'SettingController@destroy',
        'middleware' => 'can:marketplace.settings.destroy'
    ]);
    $router->bind('store', function ($id) {
        return app('Modules\Marketplace\Repositories\StoreRepository')->find($id);
    });
    $router->get('stores', [
        'as' => 'admin.marketplace.store.index',
        'uses' => 'StoreController@index',
        'middleware' => 'can:marketplace.stores.index'
    ]);
    $router->get('stores/create', [
        'as' => 'admin.marketplace.store.create',
        'uses' => 'StoreController@create',
        'middleware' => 'can:marketplace.stores.create'
    ]);
    $router->post('stores', [
        'as' => 'admin.marketplace.store.store',
        'uses' => 'StoreController@store',
        'middleware' => 'can:marketplace.stores.create'
    ]);
    $router->get('stores/{store}/edit', [
        'as' => 'admin.marketplace.store.edit',
        'uses' => 'StoreController@edit',
        'middleware' => 'can:marketplace.stores.edit'
    ]);
    $router->put('stores/{store}', [
        'as' => 'admin.marketplace.store.update',
        'uses' => 'StoreController@update',
        'middleware' => 'can:marketplace.stores.edit'
    ]);
    $router->delete('stores/{store}', [
        'as' => 'admin.marketplace.store.destroy',
        'uses' => 'StoreController@destroy',
        'middleware' => 'can:marketplace.stores.destroy'
    ]);
    $router->bind('storehistory', function ($id) {
        return app('Modules\Marketplace\Repositories\StoreHistoryRepository')->find($id);
    });
    $router->get('storehistories', [
        'as' => 'admin.marketplace.storehistory.index',
        'uses' => 'StoreHistoryController@index',
        'middleware' => 'can:marketplace.storehistories.index'
    ]);
    $router->get('storehistories/create', [
        'as' => 'admin.marketplace.storehistory.create',
        'uses' => 'StoreHistoryController@create',
        'middleware' => 'can:marketplace.storehistories.create'
    ]);
    $router->post('storehistories', [
        'as' => 'admin.marketplace.storehistory.store',
        'uses' => 'StoreHistoryController@store',
        'middleware' => 'can:marketplace.storehistories.create'
    ]);
    $router->get('storehistories/{storehistory}/edit', [
        'as' => 'admin.marketplace.storehistory.edit',
        'uses' => 'StoreHistoryController@edit',
        'middleware' => 'can:marketplace.storehistories.edit'
    ]);
    $router->put('storehistories/{storehistory}', [
        'as' => 'admin.marketplace.storehistory.update',
        'uses' => 'StoreHistoryController@update',
        'middleware' => 'can:marketplace.storehistories.edit'
    ]);
    $router->delete('storehistories/{storehistory}', [
        'as' => 'admin.marketplace.storehistory.destroy',
        'uses' => 'StoreHistoryController@destroy',
        'middleware' => 'can:marketplace.storehistories.destroy'
    ]);
    $router->bind('themes', function ($id) {
        return app('Modules\Marketplace\Repositories\ThemesRepository')->find($id);
    });
    $router->get('themes', [
        'as' => 'admin.marketplace.themes.index',
        'uses' => 'ThemesController@index',
        'middleware' => 'can:marketplace.themes.index'
    ]);
    $router->get('themes/create', [
        'as' => 'admin.marketplace.themes.create',
        'uses' => 'ThemesController@create',
        'middleware' => 'can:marketplace.themes.create'
    ]);
    $router->post('themes', [
        'as' => 'admin.marketplace.themes.store',
        'uses' => 'ThemesController@store',
        'middleware' => 'can:marketplace.themes.create'
    ]);
    $router->get('themes/{themes}/edit', [
        'as' => 'admin.marketplace.themes.edit',
        'uses' => 'ThemesController@edit',
        'middleware' => 'can:marketplace.themes.edit'
    ]);
    $router->put('themes/{themes}', [
        'as' => 'admin.marketplace.themes.update',
        'uses' => 'ThemesController@update',
        'middleware' => 'can:marketplace.themes.edit'
    ]);
    $router->delete('themes/{themes}', [
        'as' => 'admin.marketplace.themes.destroy',
        'uses' => 'ThemesController@destroy',
        'middleware' => 'can:marketplace.themes.destroy'
    ]);
    $router->bind('comment', function ($id) {
        return app('Modules\Marketplace\Repositories\CommentRepository')->find($id);
    });
    $router->get('comments', [
        'as' => 'admin.marketplace.comment.index',
        'uses' => 'CommentController@index',
        'middleware' => 'can:marketplace.comments.index'
    ]);
    $router->get('comments/create', [
        'as' => 'admin.marketplace.comment.create',
        'uses' => 'CommentController@create',
        'middleware' => 'can:marketplace.comments.create'
    ]);
    $router->post('comments', [
        'as' => 'admin.marketplace.comment.store',
        'uses' => 'CommentController@store',
        'middleware' => 'can:marketplace.comments.create'
    ]);
    $router->get('comments/{comment}/edit', [
        'as' => 'admin.marketplace.comment.edit',
        'uses' => 'CommentController@edit',
        'middleware' => 'can:marketplace.comments.edit'
    ]);
    $router->put('comments/{comment}', [
        'as' => 'admin.marketplace.comment.update',
        'uses' => 'CommentController@update',
        'middleware' => 'can:marketplace.comments.edit'
    ]);
    $router->delete('comments/{comment}', [
        'as' => 'admin.marketplace.comment.destroy',
        'uses' => 'CommentController@destroy',
        'middleware' => 'can:marketplace.comments.destroy'
    ]);
    $router->bind('categorystore', function ($id) {
        return app('Modules\Marketplace\Repositories\CategoryStoreRepository')->find($id);
    });
    $router->get('categorystores', [
        'as' => 'admin.marketplace.categorystore.index',
        'uses' => 'CategoryStoreController@index',
        'middleware' => 'can:marketplace.categorystores.index'
    ]);
    $router->get('categorystores/create', [
        'as' => 'admin.marketplace.categorystore.create',
        'uses' => 'CategoryStoreController@create',
        'middleware' => 'can:marketplace.categorystores.create'
    ]);
    $router->post('categorystores', [
        'as' => 'admin.marketplace.categorystore.store',
        'uses' => 'CategoryStoreController@store',
        'middleware' => 'can:marketplace.categorystores.create'
    ]);
    $router->get('categorystores/{categorystore}/edit', [
        'as' => 'admin.marketplace.categorystore.edit',
        'uses' => 'CategoryStoreController@edit',
        'middleware' => 'can:marketplace.categorystores.edit'
    ]);
    $router->put('categorystores/{categorystore}', [
        'as' => 'admin.marketplace.categorystore.update',
        'uses' => 'CategoryStoreController@update',
        'middleware' => 'can:marketplace.categorystores.edit'
    ]);
    $router->delete('categorystores/{categorystore}', [
        'as' => 'admin.marketplace.categorystore.destroy',
        'uses' => 'CategoryStoreController@destroy',
        'middleware' => 'can:marketplace.categorystores.destroy'
    ]);
// append





});
