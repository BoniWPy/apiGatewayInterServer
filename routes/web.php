<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
    // return $router->app->version();
    return "web";
});

$router->get('/dimana', function () {
    return "diweb";
});

$router->get('/key',function () {
    return str_rand(32);
});


$router->group(["prefix"=>"v1"],function() use ($router) {

    $router->group(["prefix"=>"auth"],function() use ($router) {
        $router->post("login","AuthController@login");
    });

    $router->group(["prefix"=>"api","middleware"=>"TrustCheck"],function() use ($router) {
        $router->get("detail","AccountController@account_detail");
        $router->get("test","AccountController@test");
        $router->get("show", "CheckInOutController@show");
        $router->get("show/{userid}", "CheckInOutController@show");
        $router->get("all", "CheckInOutController@index");
        $router->post("post","GetdataController@postdata");
        $router->get("","GetdataController@unauthorized");
    
    });
});