<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::get('/dashboard', 'HomeController@index');

/*
 * Car routes
 */
Route::resource('car', 'Models\CarController', ['except' => ['destroy', 'edit', 'update']]);

Route::post('car/delete', 'Models\CarController@destroy');
Route::post('car/edit', 'Models\CarController@edit');
Route::post('car/update', 'Models\CarController@update');

/*
 * Company routes
 */
Route::resource('company', 'Models\CompanyController', ['except' => ['destroy', 'edit', 'update']]);

Route::post('company/delete', 'Models\CompanyController@destroy');
Route::post('company/edit', 'Models\CompanyController@edit');
Route::post('company/update', 'Models\CompanyController@update');

/*
 * Role routes
 */
Route::resource('role', 'Models\RoleController', ['except' => ['destroy', 'edit', 'update']]);

Route::post('role/delete', 'Models\RoleController@destroy');
Route::post('role/edit', 'Models\RoleController@edit');
Route::post('role/update', 'Models\RoleController@update');

/*
 * Route routes
 */
Route::resource('route', 'Models\RouteController', ['except' => ['destroy', 'edit', 'update']]);

Route::post('route/delete', 'Models\RouteController@destroy');
Route::post('route/edit', 'Models\RouteController@edit');
Route::post('route/update', 'Models\RouteController@update');

/*
 * User routes
 */
Route::resource('user', 'Models\UserController', ['except' => ['destroy', 'edit', 'update']]);

Route::post('route/delete', 'Models\RouteController@destroy');
Route::post('route/edit', 'Models\RouteController@edit');
Route::post('route/update', 'Models\RouteController@update');



