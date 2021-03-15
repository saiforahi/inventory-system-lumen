<?php
use App\Http\Controllers\Auth\AuthController;
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

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});
$router->post('/login','Auth\AuthController@login');
$router->post('/otp-verification','Auth\AuthController@OTP_verification');
$router->post('/register','AuthController@register');
$router->post('/logout',['middleware'=>'auth','uses'=>'Auth\AuthController@logout']);
