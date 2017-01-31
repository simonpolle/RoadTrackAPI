<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Http\Requests\route\EditDeleteRouteRequest;
use App\Http\Requests\route\StoreUpdateRouteRequest;
use App\Models\Car;
use App\Models\Route;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
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
        return view('route.index', [
            'routes' => Route::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('route.create', [
            'users' => DB::table('users')->where('role_id', 1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRouteRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRouteRequest $request)
    {
        // Validate the request...
        $route = new Route;
        $route->user_id = $request->user_id;
        $car = DB::table('cars')->where('user_id', $request->user_id)->first();
        $route->car_id = $car->id;
        $route->distance_travelled = $request->distance_travelled;
        $route->total_cost = $request->total_cost;
        $route->save();

        return redirect()->route('route.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(EditDeleteRouteRequest $request)
    {
        return view('route.edit', [
            'route' => Route::find($request->id),
            'users' => DB::table('users')->where('role_id', 1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(StoreUpdateRouteRequest $request)
    {
        $route = Route::find($request->id);
        $route->user_id = $request->user_id;
        $car = DB::table('cars')->where('user_id', $request->user_id)->first();
        $route->car_id = $car->id;
        $route->distance_travelled = $request->distance_travelled;
        $route->total_cost = $request->total_cost;
        $route->save();

        return redirect()->route('route.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(EditDeleteRouteRequest $request)
    {
        $route = Route::where('id', $request->id);
        $route->delete();

        return redirect()->route('route.index');
    }
}
