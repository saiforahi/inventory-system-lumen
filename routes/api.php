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
    $router->delete('{id}',['middleware' => 'auth','uses' => 'ProductController@destroy']);
});
$router->group(['prefix' => 'brands'],function () use ($router){
    $router->get('all',['middleware' => 'auth','uses' => 'BrandsController@show']);
    $router->post('store',['middleware' => 'auth','uses' => 'BrandsController@create']);
    $router->delete('{id}',['middleware' => 'auth','uses' => 'BrandsController@delete']);
});
$router->group(['prefix' => 'categories'],function () use ($router){
    $router->get('all',['middleware' => 'auth','uses' => 'CategoriesController@show']);
    $router->post('store',['middleware' => 'auth','uses' => 'CategoriesController@create']);
    $router->delete('{id}',['middleware' => 'auth','uses' => 'CategoriesController@delete']);
});
$router->group(['prefix' => 'schedules'],function () use ($router){
    $router->get('all',['middleware' => 'auth','uses' => 'ScheduleController@all']);
    $router->post('create',['middleware' => 'auth','uses' => 'ScheduleController@create']);
    $router->delete('{id}',['middleware' => 'auth','uses' => 'ScheduleController@delete']);
});

