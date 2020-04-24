<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/level'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.level.create',
        'uses' => 'LevelApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.level.get.items.by',
        'uses' => 'LevelApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.level.get.item',
        'uses' => 'LevelApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.level.update',
        'uses' => 'LevelApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.level.delete',
        'uses' => 'LevelApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
