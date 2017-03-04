<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Company;
use App\Models\Route;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->get();
            $cars = Car::all();
            $cars_count = 0;

            foreach ($users as $user) {
                foreach ($cars as $car) {
                    if ($user->id == $car->user_id)
                        $cars_count++;
                }
            }

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
                'cars' => $cars_count,
                'total_cost' => $total_cost,
                'users_count' => $users_count,
                'routes' => $routes,
                'recent_routes' => $recent_routes,
                'users' => $users
            ]);
        }

        else if(Auth::user()->role_id == 3)
        {
            $cars_count = Car::all()->count();
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
                'cars' => $cars_count,
                'total_cost' => $total_cost,
                'users_count' => $users_count,
                'routes' => $routes,
                'recent_routes' => $recent_routes,
                'users' => $users
            ]);
        }

        else
            return view('errors.403');

    }
}
