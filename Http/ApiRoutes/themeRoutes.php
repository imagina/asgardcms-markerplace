<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/theme'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.theme.create',
        'uses' => 'ThemeApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.theme.get.items.by',
        'uses' => 'ThemeApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.theme.get.item',
        'uses' => 'ThemeApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.theme.update',
        'uses' => 'ThemeApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.theme.delete',
        'uses' => 'ThemeApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
