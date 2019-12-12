<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/store'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.store.create',
        'uses' => 'StoreApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.store.get.items.by',
        'uses' => 'StoreApiController@index',
        //'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.store.get.item',
        'uses' => 'StoreApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.store.update',
        'uses' => 'StoreApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.store.delete',
        'uses' => 'StoreApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
