<?php

$router->group(['prefix' => 'roles'],function () use ($router){
    $router->get('all',['middleware'=>'auth','uses'=>'Spatie\RoleController@get_all_roles']);
    $router->post('create',['middleware' => 'auth','uses' => 'Spatie\RoleController@store']);
    $router->put('update/{id}',['middleware' => 'auth','uses' => 'Spatie\RoleController@update']);
    $router->delete('delete/{id}',['middleware' => 'auth','uses' => 'Spatie\RoleController@destroy']);
});

$router->group(['prefix' => 'permission'],function () use ($router){
    $router->post('create',['middleware' => 'auth','uses'=>'Spatie\PermissionController@store']);
    $router->get('all_permissions',['middleware' => 'auth','uses' => 'Spatie\PermissionController@all_permissions']);
    $router->delete('delete/{id}',['middleware' => 'auth','uses' => 'Spatie\PermissionController@destroy']);
});