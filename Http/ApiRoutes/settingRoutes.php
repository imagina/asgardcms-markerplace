<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/setting'], function (Router $router) {
  //Route create
    $router->post('/', [
      'as' => 'marketplace.setting.create',
      'uses' => 'SettingApiController@create',
      'middleware' => ['auth:api']
    ]);
  
    //Route index
    $router->get('/', [
      'as' => 'marketplace.setting.get.items.by',
      'uses' => 'SettingApiController@index',
      'middleware' => ['auth:api']
    ]);
  
    //Route show
    $router->get('/{criteria}', [
      'as' => 'marketplace.setting.get.item',
      'uses' => 'SettingApiController@show',
      'middleware' => ['auth:api']
    ]);
    
      //Route update
    $router->put('/{criteria}', [
      'as' => 'marketplace.setting.update',
      'uses' => 'SettingApiController@update',
      'middleware' => ['auth:api']
    ]);
    
    //Route delete
    $router->delete('/{criteria}', [
      'as' => 'marketplace.setting.delete',
      'uses' => 'SettingApiController@delete',
      'middleware' => ['auth:api']
    ]);
});
