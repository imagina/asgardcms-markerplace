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
    $router->bind('favoritestore', function ($id) {
        return app('Modules\Marketplace\Repositories\FavoriteStoreRepository')->find($id);
    });
    $router->get('favoritestores', [
        'as' => 'admin.marketplace.favoritestore.index',
        'uses' => 'FavoriteStoreController@index',
        'middleware' => 'can:marketplace.favoritestores.index'
    ]);
    $router->get('favoritestores/create', [
        'as' => 'admin.marketplace.favoritestore.create',
        'uses' => 'FavoriteStoreController@create',
        'middleware' => 'can:marketplace.favoritestores.create'
    ]);
    $router->post('favoritestores', [
        'as' => 'admin.marketplace.favoritestore.store',
        'uses' => 'FavoriteStoreController@store',
        'middleware' => 'can:marketplace.favoritestores.create'
    ]);
    $router->get('favoritestores/{favoritestore}/edit', [
        'as' => 'admin.marketplace.favoritestore.edit',
        'uses' => 'FavoriteStoreController@edit',
        'middleware' => 'can:marketplace.favoritestores.edit'
    ]);
    $router->put('favoritestores/{favoritestore}', [
        'as' => 'admin.marketplace.favoritestore.update',
        'uses' => 'FavoriteStoreController@update',
        'middleware' => 'can:marketplace.favoritestores.edit'
    ]);
    $router->delete('favoritestores/{favoritestore}', [
        'as' => 'admin.marketplace.favoritestore.destroy',
        'uses' => 'FavoriteStoreController@destroy',
        'middleware' => 'can:marketplace.favoritestores.destroy'
    ]);
    $router->bind('level', function ($id) {
        return app('Modules\Marketplace\Repositories\LevelRepository')->find($id);
    });
    $router->get('levels', [
        'as' => 'admin.marketplace.level.index',
        'uses' => 'LevelController@index',
        'middleware' => 'can:marketplace.levels.index'
    ]);
    $router->get('levels/create', [
        'as' => 'admin.marketplace.level.create',
        'uses' => 'LevelController@create',
        'middleware' => 'can:marketplace.levels.create'
    ]);
    $router->post('levels', [
        'as' => 'admin.marketplace.level.store',
        'uses' => 'LevelController@store',
        'middleware' => 'can:marketplace.levels.create'
    ]);
    $router->get('levels/{level}/edit', [
        'as' => 'admin.marketplace.level.edit',
        'uses' => 'LevelController@edit',
        'middleware' => 'can:marketplace.levels.edit'
    ]);
    $router->put('levels/{level}', [
        'as' => 'admin.marketplace.level.update',
        'uses' => 'LevelController@update',
        'middleware' => 'can:marketplace.levels.edit'
    ]);
    $router->delete('levels/{level}', [
        'as' => 'admin.marketplace.level.destroy',
        'uses' => 'LevelController@destroy',
        'middleware' => 'can:marketplace.levels.destroy'
    ]);
    $router->bind('levelcriteria', function ($id) {
        return app('Modules\Marketplace\Repositories\LevelCriteriaRepository')->find($id);
    });
    $router->get('levelcriterias', [
        'as' => 'admin.marketplace.levelcriteria.index',
        'uses' => 'LevelCriteriaController@index',
        'middleware' => 'can:marketplace.levelcriterias.index'
    ]);
    $router->get('levelcriterias/create', [
        'as' => 'admin.marketplace.levelcriteria.create',
        'uses' => 'LevelCriteriaController@create',
        'middleware' => 'can:marketplace.levelcriterias.create'
    ]);
    $router->post('levelcriterias', [
        'as' => 'admin.marketplace.levelcriteria.store',
        'uses' => 'LevelCriteriaController@store',
        'middleware' => 'can:marketplace.levelcriterias.create'
    ]);
    $router->get('levelcriterias/{levelcriteria}/edit', [
        'as' => 'admin.marketplace.levelcriteria.edit',
        'uses' => 'LevelCriteriaController@edit',
        'middleware' => 'can:marketplace.levelcriterias.edit'
    ]);
    $router->put('levelcriterias/{levelcriteria}', [
        'as' => 'admin.marketplace.levelcriteria.update',
        'uses' => 'LevelCriteriaController@update',
        'middleware' => 'can:marketplace.levelcriterias.edit'
    ]);
    $router->delete('levelcriterias/{levelcriteria}', [
        'as' => 'admin.marketplace.levelcriteria.destroy',
        'uses' => 'LevelCriteriaController@destroy',
        'middleware' => 'can:marketplace.levelcriterias.destroy'
    ]);
    $router->bind('leveltype', function ($id) {
        return app('Modules\Marketplace\Repositories\LevelTypeRepository')->find($id);
    });
    $router->get('leveltypes', [
        'as' => 'admin.marketplace.leveltype.index',
        'uses' => 'LevelTypeController@index',
        'middleware' => 'can:marketplace.leveltypes.index'
    ]);
    $router->get('leveltypes/create', [
        'as' => 'admin.marketplace.leveltype.create',
        'uses' => 'LevelTypeController@create',
        'middleware' => 'can:marketplace.leveltypes.create'
    ]);
    $router->post('leveltypes', [
        'as' => 'admin.marketplace.leveltype.store',
        'uses' => 'LevelTypeController@store',
        'middleware' => 'can:marketplace.leveltypes.create'
    ]);
    $router->get('leveltypes/{leveltype}/edit', [
        'as' => 'admin.marketplace.leveltype.edit',
        'uses' => 'LevelTypeController@edit',
        'middleware' => 'can:marketplace.leveltypes.edit'
    ]);
    $router->put('leveltypes/{leveltype}', [
        'as' => 'admin.marketplace.leveltype.update',
        'uses' => 'LevelTypeController@update',
        'middleware' => 'can:marketplace.leveltypes.edit'
    ]);
    $router->delete('leveltypes/{leveltype}', [
        'as' => 'admin.marketplace.leveltype.destroy',
        'uses' => 'LevelTypeController@destroy',
        'middleware' => 'can:marketplace.leveltypes.destroy'
    ]);
    $router->bind('benefits', function ($id) {
        return app('Modules\Marketplace\Repositories\BenefitsRepository')->find($id);
    });
    $router->get('benefits', [
        'as' => 'admin.marketplace.benefits.index',
        'uses' => 'BenefitsController@index',
        'middleware' => 'can:marketplace.benefits.index'
    ]);
    $router->get('benefits/create', [
        'as' => 'admin.marketplace.benefits.create',
        'uses' => 'BenefitsController@create',
        'middleware' => 'can:marketplace.benefits.create'
    ]);
    $router->post('benefits', [
        'as' => 'admin.marketplace.benefits.store',
        'uses' => 'BenefitsController@store',
        'middleware' => 'can:marketplace.benefits.create'
    ]);
    $router->get('benefits/{benefits}/edit', [
        'as' => 'admin.marketplace.benefits.edit',
        'uses' => 'BenefitsController@edit',
        'middleware' => 'can:marketplace.benefits.edit'
    ]);
    $router->put('benefits/{benefits}', [
        'as' => 'admin.marketplace.benefits.update',
        'uses' => 'BenefitsController@update',
        'middleware' => 'can:marketplace.benefits.edit'
    ]);
    $router->delete('benefits/{benefits}', [
        'as' => 'admin.marketplace.benefits.destroy',
        'uses' => 'BenefitsController@destroy',
        'middleware' => 'can:marketplace.benefits.destroy'
    ]);
    $router->bind('storecontact', function ($id) {
        return app('Modules\Marketplace\Repositories\StoreContactRepository')->find($id);
    });
    $router->get('storecontacts', [
        'as' => 'admin.marketplace.storecontact.index',
        'uses' => 'StoreContactController@index',
        'middleware' => 'can:marketplace.storecontacts.index'
    ]);
    $router->get('storecontacts/create', [
        'as' => 'admin.marketplace.storecontact.create',
        'uses' => 'StoreContactController@create',
        'middleware' => 'can:marketplace.storecontacts.create'
    ]);
    $router->post('storecontacts', [
        'as' => 'admin.marketplace.storecontact.store',
        'uses' => 'StoreContactController@store',
        'middleware' => 'can:marketplace.storecontacts.create'
    ]);
    $router->get('storecontacts/{storecontact}/edit', [
        'as' => 'admin.marketplace.storecontact.edit',
        'uses' => 'StoreContactController@edit',
        'middleware' => 'can:marketplace.storecontacts.edit'
    ]);
    $router->put('storecontacts/{storecontact}', [
        'as' => 'admin.marketplace.storecontact.update',
        'uses' => 'StoreContactController@update',
        'middleware' => 'can:marketplace.storecontacts.edit'
    ]);
    $router->delete('storecontacts/{storecontact}', [
        'as' => 'admin.marketplace.storecontact.destroy',
        'uses' => 'StoreContactController@destroy',
        'middleware' => 'can:marketplace.storecontacts.destroy'
    ]);
// append












});
