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

/*
 * Returns the authenticated user
 */
$router->get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/*
 * Routes routes
 */
$router->group(['prefix' => 'route', 'namespace' => 'Models\Api'], function () use ($router) {
    $router->get('/', 'RouteController@index')->name('route.index');
    $router->get('/{id}', 'RouteController@getById')->name('route.getById');
    $router->get('create', 'RouteController@create')->name('route.create');
    $router->post('store', 'RouteController@store')->name('route.store');
});

/*
 * Routes routes
 */
$router->group(['prefix' => 'car', 'namespace' => 'Models\Api'], function () use ($router) {
    $router->get('/{id}', 'CarController@getById')->name('car.getById');
});