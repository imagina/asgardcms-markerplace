<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/comments'], function (Router $router) {
    //Route create
    $router->post('/', [
        'as' => 'marketplace.comment.create',
        'uses' => 'CommentApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'marketplace.comment.get.items.by',
        'uses' => 'CommentApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'marketplace.comment.get.item',
        'uses' => 'CommentApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'marketplace.comment.update',
        'uses' => 'CommentApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'marketplace.comment.delete',
        'uses' => 'CommentApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
