<?php

namespace App\Http\Controllers\Models\Api;


use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Cost;
use App\Models\Location;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LocationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $route = new Route;
        $route->user_id = Auth::user()->id;
        $cars = DB::table('cars')->where('user_id', Auth::user()->id)->first();
        $car = Car::find($cars->id);
        $route->car()->associate($car);

        $route->distance_travelled = 1;
        $route->total_cost = 1;

        $cost = Cost::find(1);
        $route->cost()->associate($cost);

        $route->save();

        $totalKm = 0;

        foreach ($request->locations as $key => $location)
        {
            $newLocation = new Location;
            $newLocation->lat = $request->locations[$key]["latitude"];
            $newLocation->lng = $request->locations[$key]["longitude"];

            $route = Route::find($route->id);
            $newLocation->route()->associate($route);

            $newLocation->route_id = $route->id;
            $newLocation->save();

            if ($key + 1 < count($request->locations))
            {
                $lat1 = $request->locations[$key]["latitude"];
                $lat2 = $request->locations[$key + 1]["latitude"];

                $lon1 = $request->locations[$key]["longitude"];
                $lon2 = $request->locations[$key + 1]["longitude"];

                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $kms = $miles * 1.609344;
                $totalKm += $kms;
            }
        }

        $route->distance_travelled = (float)$totalKm;
        $route->total_cost = (float)$totalKm * (float)$route->cost->cost;
        $route->save();
    }
}
