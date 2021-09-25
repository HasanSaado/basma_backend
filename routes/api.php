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

Route::group([
  'middleware' => 'api',
  'namespace' => 'App\Http\Controllers',
  'prefix' => 'auth'
], function($router) {
  Route::post('login', 'AuthController@login');
  Route::post('register', 'AuthController@register');
  Route::post('logout', 'AuthController@logout');
  Route::get('profile', 'AuthController@profile');
  Route::post('refresh', 'AuthController@refresh');
});

Route::group([
  'middleware' => 'api',
  'namespace' => 'App\Http\Controllers',
  'prefix' => 'customer'
], function($router) {
  Route::post('login', 'CustomerController@login');
  Route::post('register', 'CustomerController@register');
  Route::get('profile', 'CustomerController@profile');
  Route::post('refresh', 'CustomerController@refresh');
  Route::get('index', 'CustomerController@index');
  Route::post('logout', 'CustomerController@logout');
});

Route::group([
  'middleware' => 'api',
  'namespace' => 'App\Http\Controllers',
  'prefix' => 'login'
], function($router) {
  Route::get('index', 'LoginController@index');
  Route::post('add', 'LoginController@add');
});