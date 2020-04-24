<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/email'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.email.create',
        'uses' => 'EmailApiController@create',
        'middleware' => ['captcha']
    ]);

    /*//Route index
    $router->get('/', [
        'as' => 'marketplace.email.get.items.by',
        'uses' => 'EmailApiController@index',
        //'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.email.get.item',
        'uses' => 'EmailApiController@show',
        //'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.email.update',
        'uses' => 'EmailApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.email.delete',
        'uses' => 'EmailApiController@delete',
        'middleware' => ['auth:api']
    ]);*/
});

