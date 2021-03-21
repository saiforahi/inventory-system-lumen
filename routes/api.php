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
$router->get('/user',['middleware'=>'auth',function(){
    return response()->json(['status'=>true,'data'=>auth()->user()]);
}]);
$router->group(['prefix' => 'users'],function () use ($router){
    $router->get('all',['middleware' => 'auth','uses' => 'UserController@all_users']);
    $router->post('store',['middleware' => 'auth','uses' => 'UserController@store']);
    $router->delete('{id}',['middleware' => 'auth','uses' => 'UserController@destroy']);
});
$router->group(['prefix' => 'products'],function () use ($router){
    $router->get('all',['middleware' => 'auth','uses' => 'ProductController@all_products']);
    $router->post('store',['middleware' => 'auth','uses' => 'ProductController@store']);
    $router->delete('{id}',['middleware' => 'auth','uses' => 'ProductController
    +-@destroy']);
});

