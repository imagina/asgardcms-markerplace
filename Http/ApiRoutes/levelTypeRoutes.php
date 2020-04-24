<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/level-type'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.level.type.create',
        'uses' => 'LevelTypeApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.level.type.get.items.by',
        'uses' => 'LevelTypeApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.level.type.get.item',
        'uses' => 'LevelTypeApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.level.type.update',
        'uses' => 'LevelTypeApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.level.type.delete',
        'uses' => 'LevelTypeApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
