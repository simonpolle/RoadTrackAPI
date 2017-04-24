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
use App\Http\Middleware;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

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
    $router->get('/licence/asc', 'CarController@indexLicenceAscending')->name('car.indexLicenceAscending');
    $router->get('/licence/desc', 'CarController@indexLicenceDescending')->name('car.indexLicenceDescending');
    $router->get('pdf', 'CarController@pdf')->name('car.pdf');
    $router->get('excel', 'CarController@excel')->name('car.excel');
    $router->get('create', 'CarController@create')->name('car.create');
    $router->post('store', 'CarController@store')->name('car.store');
    $router->post('edit', 'CarController@edit')->name('car.edit');
    $router->post('update', 'CarController@update')->name('car.update');
    $router->post('destroy', 'CarController@destroy')->name('car.destroy');
});

/*
 * Company routes
 */
$router->group(['prefix' => 'company', 'namespace' => 'Models\Web', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'CompanyController@index')->name('company.index');
    $router->get('/name/asc', 'CompanyController@indexNameAscending')->name('company.indexNameAscending');
    $router->get('/name/desc', 'CompanyController@indexNameDescending')->name('company.indexNameDescending');
    $router->get('/address/asc', 'CompanyController@indexAddressAscending')->name('company.indexAddressAscending');
    $router->get('/address/desc', 'CompanyController@indexAddressDescending')->name('company.indexAddressDescending');
    $router->get('pdf', 'CompanyController@pdf')->name('company.pdf');
    $router->get('excel', 'CompanyController@excel')->name('company.excel');
    $router->get('create', 'CompanyController@create')->name('company.create');
    $router->post('store', 'CompanyController@store')->name('company.store');
    $router->post('edit', 'CompanyController@edit')->name('company.edit');
    $router->post('update', 'CompanyController@update')->name('company.update');
    $router->post('destroy', 'CompanyController@destroy')->name('company.destroy');
});

/*
 * Role routes
 */
$router->group(['prefix' => 'role', 'namespace' => 'Models\Web', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'RoleController@index')->name('role.index');
    $router->get('/name/asc', 'RoleController@indexNameAscending')->name('role.indexNameAscending');
    $router->get('/name/desc', 'RoleController@indexNameDescending')->name('role.indexNameDescending');
    $router->get('create', 'RoleController@create')->name('role.create');
    $router->post('store', 'RoleController@store')->name('role.store');
    $router->post('edit', 'RoleController@edit')->name('role.edit');
    $router->post('update', 'RoleController@update')->name('role.update');
    $router->post('destroy', 'RoleController@destroy')->name('role.destroy');
});

/*
 * Route routes
 */
$router->group(['prefix' => 'route', 'namespace' => 'Models\Web', 'middleware' => ['company']], function () use ($router) {
    $router->get('/', 'RouteController@index')->name('route.index');
    $router->get('/distance/asc', 'RouteController@indexDistanceAscending')->name('route.indexDistanceAscending');
    $router->get('/distance/desc', 'RouteController@indexDistanceDescending')->name('route.indexDistanceDescending');
    $router->get('/cost/asc', 'RouteController@indexCostAscending')->name('route.indexCostAscending');
    $router->get('/cost/desc', 'RouteController@indexCostDescending')->name('route.indexCostDescending');
    $router->get('pdf', 'RouteController@pdf')->name('route.pdf');
    $router->get('excel', 'RouteController@excel')->name('route.excel');
    $router->get('create', 'RouteController@create')->name('route.create');
    $router->post('store', 'RouteController@store')->name('route.store');
    $router->post('edit', 'RouteController@edit')->name('route.edit');
    $router->post('update', 'RouteController@update')->name('route.update');
    $router->post('destroy', 'RouteController@destroy')->name('route.destroy');
});

/*
 * User routes
 */
$router->group(['prefix' => 'user', 'namespace' => 'Models\Web', 'middleware' => ['company']], function () use ($router) {
    $router->get('/', 'UserController@index')->name('user.index');
    $router->get('/name/asc', 'UserController@indexNameAscending')->name('user.indexNameAscending');
    $router->get('/name/desc', 'UserController@indexNameDescending')->name('user.indexNameDescending');
    $router->get('/email/asc', 'UserController@indexEmailAscending')->name('user.indexEmailAscending');
    $router->get('/email/desc', 'UserController@indexEmailDescending')->name('user.indexEmailDescending');
    $router->get('create', 'UserController@create')->name('user.create');
    $router->post('store', 'UserController@store')->name('user.store');
    $router->post('edit', 'UserController@edit')->name('user.edit');
    $router->post('update', 'UserController@update')->name('user.update');
    $router->post('destroy', 'UserController@destroy')->name('user.destroy');
});




