<?php

namespace App\Http\Controllers\Models\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\route\StoreUpdateRouteRequest;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Route::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return DB::table('users')->where('role_id', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRouteRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRouteRequest $request)
    {
        // google api key : AIzaSyCWKyc_A3rh2Pkp6gqZ_vQpE-N5cPSzJDU
        $route = new Route;
        $route->user_id = $request->user_id;
        $car = DB::table('cars')->where('user_id', $request->user_id)->first();
        $route->car_id = $car->id;
        $route->distance_travelled = $request->distance_travelled;
        $route->total_cost = $request->total_cost;
        $route->save();
        return response()->json($route)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    }
}
