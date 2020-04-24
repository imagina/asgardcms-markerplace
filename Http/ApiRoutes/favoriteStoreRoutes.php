<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/favorite-store'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.favorite-store.create',
        'uses' => 'FavoriteStoreApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.favorite-store.get.items.by',
        'uses' => 'FavoriteStoreApiController@index',
        //'middleware' => ['auth:api'] testing
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.favorite-store.get.item',
        'uses' => 'FavoriteStoreApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.favorite-store.update',
        'uses' => 'FavoriteStoreApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.favorite-store.delete',
        'uses' => 'FavoriteStoreApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
