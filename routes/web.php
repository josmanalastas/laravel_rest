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
    return $router->app->version();
});

$router->group(
    ['prefix' => 'products', 'middleware' => 'auth'],
    function ($app) {
        $app->get('', 'ProductController@getProducts');
        $app->get('/{id}', 'ProductController@getProduct');
        $app->post('', 'ProductController@createProduct');
        $app->put('/{id}', 'ProductController@updateProduct');
        $app->delete('/{id}', 'ProductController@deleteProduct');
    }
);


$router->post('/users/login', 'LoginController@login');
