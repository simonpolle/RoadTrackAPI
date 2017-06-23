<?php

namespace App\Http\Controllers\Models\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\route\EditDeleteRouteRequest;
use App\Http\Requests\route\StoreUpdateRouteRequest;
use App\Models\Car;
use App\Models\Cost;
use App\Models\Location;
use App\Models\Route;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->paginate(10);

            return view('route.index', [
                'routes' => $routes
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('route.index', [
                'routes' => Route::paginate(10)
            ]);
        }
    }

    public function search()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->get();

            return view('route.search', [
                'routes' => $routes
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('route.search', [
                'routes' => Route::get()
            ]);
        }
    }

    public function indexDistanceAscending()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->orderBy('distance_travelled', 'asc')->paginate(10);

            return view('route.index', [
                'routes' => $routes
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('route.index', [
                'routes' => Route::orderBy('distance_travelled', 'asc')->paginate(10)
            ]);
        }
    }

    public function indexDistanceDescending()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->orderBy('distance_travelled', 'desc')->paginate(10);

            return view('route.index', [
                'routes' => $routes
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('route.index', [
                'routes' => Route::orderBy('distance_travelled', 'desc')->paginate(10)
            ]);
        }
    }

    public function indexCostAscending()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->orderBy('total_cost', 'asc')->paginate(10);

            return view('route.index', [
                'routes' => $routes
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('route.index', [
                'routes' => Route::orderBy('total_cost', 'asc')->paginate(10)
            ]);
        }
    }

    public function indexCostDescending()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->orderBy('total_cost', 'desc')->paginate(10);

            return view('route.index', [
                'routes' => $routes
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('route.index', [
                'routes' => Route::orderBy('total_cost', 'desc')->paginate(10)
            ]);
        }
    }

    public function pdf(Request $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->orderBy('total_cost', 'asc')->paginate(10);

            view()->share('routes', $routes);
        }
        else if (Auth::user()->role_id == 3)
        {
            $routes = Route::all();
            view()->share('routes', $routes);
        }

        if ($request->has('download'))
        {
            $pdf = PDF::loadView('route.pdf');
            return $pdf->download('routes.pdf');
        }

        return view('route.index');
    }

    public function excel()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->orderBy('total_cost', 'asc')->get();
        }
        else if (Auth::user()->role_id == 3)
        {
            $routes = Route::all();
        }
        Excel::create('routes', function ($excel) use ($routes)
        {
            $excel->sheet('Sheet 1', function ($sheet) use ($routes)
            {
                $sheet->fromArray($routes);
            });
        })->download('xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role_id == 2)
        {
            return view('route.create', [
                'users' => User::where('company_id', Auth::user()->company_id)->get(),
                'costs' => Cost::where('company_id', Auth::user()->company_id)->get(),
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('route.create', [
                'users' => User::where('company_id', Auth::user()->company_id)->get(),
                'costs' => Cost::all(),
            ]);
        }
    }

    /**
     * Show the details of a resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        $route = Route::find($request->id);
        $locations = Location::where('route_id', $request->id)->get(['lat', 'lng']);
        /* @var Collection $locations */
        $coordinates = $locations->map(function (Location $location)
        {
            return $location->lat . ',' . $location->lng;
        });

        $coordinates = implode('|', $coordinates->toArray());
        if (empty($coordinates))
        {
            return view('route.details', [
                'route' => $route,
                'coordinates' => $coordinates,
                'firstLocation' => "",
            ]);
        }
        else
        {
            $guzzleClient = new \GuzzleHttp\Client();
            $url = sprintf('https://roads.googleapis.com/v1/snapToRoads?path=%s&interpolate=true&key=%s', $coordinates, env('GOOGLE_API_KEY'));

            $res = $guzzleClient->requestAsync('GET', $url)->wait();
            $res = json_decode((string)$res->getBody());

            $coordinates = array_map(function ($point)
            {
                return (object)$point->location;
            }, $res->snappedPoints);

            $json = json_encode($coordinates);
            $json = str_replace("latitude", "lat", $json);
            $json = str_replace("longitude", "lng", $json);
            $coordinates = json_decode($json);

            return view('route.details', [
                'route' => $route,
                'coordinates' => $coordinates,
                'firstLocation' => $coordinates[0],
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRouteRequest|StoreUpdateRouteRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRouteRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            if (!in_array($request->user_id, $users->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $route = new Route;
                $route->user_id = $request->user_id;
                $car = DB::table('cars')->where('user_id', $request->user_id)->first();
                $route->car_id = $car->id;
                $route->distance_travelled = number_format($request->distance_travelled, 2);
                $route->total_cost = number_format($request->total_cost, 2);
                $route->cost_id = $request->cost_id;
                $route->save();

                return redirect()->route('route.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $route = new Route;
            $route->user_id = $request->user_id;
            $car = DB::table('cars')->where('user_id', $request->user_id)->first();
            $route->car_id = $car->id;
            $route->distance_travelled = $request->distance_travelled;
            $route->total_cost = $request->total_cost;
            $route->cost_id = $request->cost_id;
            $route->save();

            return redirect()->route('route.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
        if (Auth::user()->role_id == 2)
        {
            return view('route.edit', [
                'users' => User::where('company_id', Auth::user()->company_id)->get(),
                'route' => Route::find($request->id),
                'costs' => Cost::where('company_id', Auth::user()->company_id)->get(),
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('route.edit', [
                'cars' => Car::all(),
                'route' => Route::find($request->id),
                'users' => DB::table('users')->where('role_id', 1)->get(),
                'costs' => Cost::all(),
            ]);
        }
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
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->pluck('id');

            if (!in_array($request->id, $routes->toArray()) || !in_array($request->user_id, $users->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
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
        }
        else if (Auth::user()->role_id == 3)
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
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $routes = Route::whereIn('user_id', $users)->pluck('id');

            if (!in_array($request->id, $routes->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $route = Route::where('id', $request->id);
                $route->delete();

                return redirect()->route('route.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $route = Route::where('id', $request->id);
            $route->delete();

            return redirect()->route('route.index');
        }
    }
}
