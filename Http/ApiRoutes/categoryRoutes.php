<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/category'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.category.create',
        'uses' => 'CategoryApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.category.get.items.by',
        'uses' => 'CategoryApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.category.get.item',
        'uses' => 'CategoryApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.category.update',
        'uses' => 'CategoryApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.category.delete',
        'uses' => 'CategoryApiController@delete',
        'middleware' => ['auth:api']
    ]);
});

