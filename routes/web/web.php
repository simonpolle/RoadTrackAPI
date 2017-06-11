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
/* @var $router \Illuminate\Contracts\Routing\Registrar */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::get('/logout', function()
{
    Auth::logout();
    return Redirect::to('/login');
})->name('logout');

Route::get('/forbidden', function()
{
    return view('errors.403');
})->name('forbidden');

/*
 * Car routes
 */
$router->group(['prefix' => 'car', 'namespace' => 'Models\Web', 'middleware' => ['company']], function () use ($router) {
    $router->get('/', 'CarController@index')->name('car.index');
    $router->get('/search', 'CarController@search')->name('car.search');
    $router->get('/licence/asc', 'CarController@indexLicenceAscending')->name('car.indexLicenceAscending');
    $router->get('/licence/desc', 'CarController@indexLicenceDescending')->name('car.indexLicenceDescending');
    $router->get('pdf', 'CarController@pdf')->name('car.pdf');
    $router->get('excel', 'CarController@excel')->name('car.excel');
    $router->get('create', 'CarController@create')->name('car.create');
    $router->post('store', 'CarController@store')->name('car.store');
    $router->get('edit', 'CarController@edit')->name('car.edit');
    $router->post('update', 'CarController@update')->name('car.update');
    $router->post('destroy', 'CarController@destroy')->name('car.destroy');
});

/*
 * Company routes
 */
$router->group(['prefix' => 'company', 'namespace' => 'Models\Web', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'CompanyController@index')->name('company.index');
    $router->get('/search', 'CompanyController@search')->name('company.search');
    $router->get('/name/asc', 'CompanyController@indexNameAscending')->name('company.indexNameAscending');
    $router->get('/name/desc', 'CompanyController@indexNameDescending')->name('company.indexNameDescending');
    $router->get('/address/asc', 'CompanyController@indexAddressAscending')->name('company.indexAddressAscending');
    $router->get('/address/desc', 'CompanyController@indexAddressDescending')->name('company.indexAddressDescending');
    $router->get('pdf', 'CompanyController@pdf')->name('company.pdf');
    $router->get('excel', 'CompanyController@excel')->name('company.excel');
    $router->get('create', 'CompanyController@create')->name('company.create');
    $router->post('store', 'CompanyController@store')->name('company.store');
    $router->get('edit', 'CompanyController@edit')->name('company.edit');
    $router->post('update', 'CompanyController@update')->name('company.update');
    $router->post('destroy', 'CompanyController@destroy')->name('company.destroy');
});

/*
 * Role routes
 */
$router->group(['prefix' => 'role', 'namespace' => 'Models\Web', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'RoleController@index')->name('role.index');
    $router->get('/search', 'RoleController@search')->name('role.search');
    $router->get('/name/asc', 'RoleController@indexNameAscending')->name('role.indexNameAscending');
    $router->get('/name/desc', 'RoleController@indexNameDescending')->name('role.indexNameDescending');
    $router->get('create', 'RoleController@create')->name('role.create');
    $router->post('store', 'RoleController@store')->name('role.store');
    $router->get('edit', 'RoleController@edit')->name('role.edit');
    $router->post('update', 'RoleController@update')->name('role.update');
    $router->post('destroy', 'RoleController@destroy')->name('role.destroy');
});

/*
 * Route routes
 */
$router->group(['prefix' => 'route', 'namespace' => 'Models\Web', 'middleware' => ['company']], function () use ($router) {
    $router->get('/', 'RouteController@index')->name('route.index');
    $router->get('/search', 'RouteController@search')->name('route.search');
    $router->get('/distance/asc', 'RouteController@indexDistanceAscending')->name('route.indexDistanceAscending');
    $router->get('/distance/desc', 'RouteController@indexDistanceDescending')->name('route.indexDistanceDescending');
    $router->get('/cost/asc', 'RouteController@indexCostAscending')->name('route.indexCostAscending');
    $router->get('/cost/desc', 'RouteController@indexCostDescending')->name('route.indexCostDescending');
    $router->get('pdf', 'RouteController@pdf')->name('route.pdf');
    $router->get('excel', 'RouteController@excel')->name('route.excel');
    $router->get('create', 'RouteController@create')->name('route.create');
    $router->get('details', 'RouteController@details')->name('route.details');
    $router->post('store', 'RouteController@store')->name('route.store');
    $router->get('edit', 'RouteController@edit')->name('route.edit');
    $router->post('update', 'RouteController@update')->name('route.update');
    $router->post('destroy', 'RouteController@destroy')->name('route.destroy');
});

/*
 * Cost routes
 */
$router->group(['prefix' => 'cost', 'namespace' => 'Models\Web', 'middleware' => ['company']], function () use ($router)
{
    $router->get('/', 'CostController@index')->name('cost.index');
    $router->get('/search', 'CostController@search')->name('cost.search');
    $router->get('/name/asc', 'CostController@indexNameAscending')->name('cost.indexNameAscending');
    $router->get('/name/desc', 'CostController@indexNameDescending')->name('cost.indexNameDescending');
    $router->get('pdf', 'CostController@pdf')->name('cost.pdf');
    $router->get('excel', 'CostController@excel')->name('cost.excel');
    $router->get('create', 'CostController@create')->name('cost.create');
    $router->post('store', 'CostController@store')->name('cost.store');
    $router->get('edit', 'CostController@edit')->name('cost.edit');
    $router->post('update', 'CostController@update')->name('cost.update');
    $router->post('destroy', 'CostController@destroy')->name('cost.destroy');
});

/*
 * User routes
 */
$router->group(['prefix' => 'user', 'namespace' => 'Models\Web', 'middleware' => ['company']], function () use ($router) {
    $router->get('/', 'UserController@index')->name('user.index');
    $router->get('/search', 'UserController@search')->name('user.search');
    $router->get('/name/asc', 'UserController@indexNameAscending')->name('user.indexNameAscending');
    $router->get('/name/desc', 'UserController@indexNameDescending')->name('user.indexNameDescending');
    $router->get('/email/asc', 'UserController@indexEmailAscending')->name('user.indexEmailAscending');
    $router->get('/email/desc', 'UserController@indexEmailDescending')->name('user.indexEmailDescending');
    $router->get('pdf', 'UserController@pdf')->name('user.pdf');
    $router->get('excel', 'UserController@excel')->name('user.excel');
    $router->get('create', 'UserController@create')->name('user.create');
    $router->get('details', 'UserController@details')->name('user.details');
    $router->post('store', 'UserController@store')->name('user.store');
    $router->get('edit', 'UserController@edit')->name('user.edit');
    $router->post('update', 'UserController@update')->name('user.update');
    $router->post('destroy', 'UserController@destroy')->name('user.destroy');
});