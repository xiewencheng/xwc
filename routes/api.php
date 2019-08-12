<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('users', 'App\Api\Controllers\UserController@show');
    $api->post('register', 'App\Api\Controllers\UserController@register');
    $api->post('login', 'App\Api\Controllers\LoginController@login');
    $api->get('store', 'App\Api\Controllers\StoreController@store');
    $api->get('delete/{id}', 'App\Api\Controllers\StoreController@delete');
    $api->post('refresh', 'App\Api\Controllers\StoreController@refresh');
    $api->get('cate','App\Api\Controllers\StoreController@cate');
    $api->get('comments','App\Api\Controllers\StoreController@Comments');
});
