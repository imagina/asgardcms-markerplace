<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/store-contact'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.store.contact.create',
        'uses' => 'StoreContactApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.store.contact.get.items.by',
        'uses' => 'StoreContactApiController@index',
        //'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.store.contact.get.item',
        'uses' => 'StoreContactApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.store.contact.update',
        'uses' => 'StoreContactApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.store.contact.delete',
        'uses' => 'StoreContactApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
