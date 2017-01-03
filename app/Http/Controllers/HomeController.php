<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Route;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all()->count();
        $total_cost = 0;
        $routes = Route::all();
        foreach ($routes as $route) {
            $total_cost += $route->total_cost;
        }
        $users_count = User::all()->count();
        $routes = Route::all()->count();
        $recent_routes = Route::all()->take(4);
        $users = User::all();
        return view('dashboard', [
            'cars' => $cars,
            'total_cost' => $total_cost,
            'users_count' => $users_count,
            'routes' => $routes,
            'recent_routes' => $recent_routes,
            'users' => $users
        ]);
    }
}
