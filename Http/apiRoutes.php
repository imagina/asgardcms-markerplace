<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'marketplace/v1'], function (Router $router) {
    require('ApiRoutes/categoryRoutes.php');
    require('ApiRoutes/commentRoutes.php');
    require('ApiRoutes/settingRoutes.php');
    require('ApiRoutes/storeHistoryRoutes.php');
    require('ApiRoutes/storeRoutes.php');
    require('ApiRoutes/themeRoutes.php');
    require('ApiRoutes/favoriteStoreRoutes.php');
    require('ApiRoutes/levelRoutes.php');
    require('ApiRoutes/levelCriteriaRoutes.php');
    require('ApiRoutes/levelTypeRoutes.php');
    require('ApiRoutes/emailRoutes.php');
});
