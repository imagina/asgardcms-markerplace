<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/level-criteria'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.level.criteria.create',
        'uses' => 'LevelCriteriaApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.level.criteria.get.items.by',
        'uses' => 'LevelCriteriaApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.level.criteria.get.item',
        'uses' => 'LevelCriteriaApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.level.criteria.update',
        'uses' => 'LevelCriteriaApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.level.criteria.delete',
        'uses' => 'LevelCriteriaApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
