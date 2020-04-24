<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/benefit'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.benefit.create',
        'uses' => 'BenefitApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.benefit.get.items.by',
        'uses' => 'BenefitApiController@index',
        //'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.benefit.get.item',
        'uses' => 'BenefitApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.benefit.update',
        'uses' => 'BenefitApiController@update',
        'middleware' => ['auth:api']
    ]);
    //Rating
    $router->post('/rating/{criteria}', [
        'as' => 'marketplace.benefit.rating',
        'uses' => 'BenefitApiController@rating',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.benefit.delete',
        'uses' => 'BenefitApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
