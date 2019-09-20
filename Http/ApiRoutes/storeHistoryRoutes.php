<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/store-history'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.store-history.create',
        'uses' => 'StoreHistoryApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.store-history.get.items.by',
        'uses' => 'StoreHistoryApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.store-history.get.item',
        'uses' => 'StoreHistoryApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.store-history.update',
        'uses' => 'StoreHistoryApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.store-history.delete',
        'uses' => 'StoreHistoryApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
