<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::delete('logout', 'AuthController@logout');
});

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix'    => 'announcements',
    'middleware' => ['auth:api', 'check.role'],
], function () {
    Route::get('/', ['uses' => 'AnnouncementController@index']);
    Route::post('/', ['uses' => 'AnnouncementController@store']);
    Route::get('{id}', ['uses' => 'AnnouncementController@show']);
    Route::patch('{id}', ['uses' => 'AnnouncementController@update']);
    Route::delete('{id}', ['uses' => 'AnnouncementController@destroy']);
});
