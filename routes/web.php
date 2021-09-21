<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/usuarios', 'UsuarioController@index');

$router->group(['prefix' => 'usuario'], function() use ($router){

    $router->get('/{id}', 'UsuarioController@show');

    $router->post('/cadastrar', 'UsuarioController@store');
    
    $router->put('/{id}/atualizar', 'UsuarioController@update');
    
    $router->delete('/{id}/deletar', 'UsuarioController@destroy');

});

$router->post('/login', 'Auth\AuthenticateController@login');

// $route->post('/info', 'Auth\AuthenticateController@me');