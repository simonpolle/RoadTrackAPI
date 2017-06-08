<?php

namespace App\Http\Controllers\Models\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\EditDeleteCarRequest;
use App\Http\Requests\Car\StoreUpdateCarRequest;
use App\Models\Car;
use App\Models\Route;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CarController extends Controller
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
            $cars = Car::whereIn('user_id', $users)->paginate(10);
            return view('car.index', [
                'cars' => $cars
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('car.index', [
                'cars' => Car::paginate(10)
            ]);
        }
    }

    public function search()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $cars = Car::whereIn('user_id', $users)->get();
            return view('car.search', [
                'cars' => $cars
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('car.search', [
                'cars' => Car::all()
            ]);
        }
    }

    public function indexLicenceAscending()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $cars = Car::whereIn('user_id', $users)->orderBy('licence_plate', 'asc')->paginate(10);
            return view('car.index', [
                'cars' => $cars
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('car.index', [
                'cars' => Car::orderBy('licence_plate', 'asc')->paginate(10)
            ]);
        }
    }

    public function indexLicenceDescending()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $cars = Car::whereIn('user_id', $users)->orderBy('licence_plate', 'desc')->paginate(10);
            return view('car.index', [
                'cars' => $cars
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('car.index', [
                'cars' => Car::orderBy('licence_plate', 'desc')->paginate(10)
            ]);
        }
    }

    public function pdf(Request $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $cars = Car::whereIn('user_id', $users)->orderBy('licence_plate', 'desc')->paginate(10);
            view()->share('cars', $cars);
        }
        else if (Auth::user()->role_id == 3)
        {
            $cars = Car::all();
            view()->share('cars', $cars);
        }

        if ($request->has('download'))
        {
            $pdf = PDF::loadView('car.pdf');
            return $pdf->download('car.pdf');
        }

        return view('company.index');
    }

    public function excel()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $cars = Car::whereIn('user_id', $users)->orderBy('licence_plate', 'desc')->get();

            Excel::create('cars', function ($excel) use ($cars)
            {
                $excel->sheet('Sheet 1', function ($sheet) use ($cars)
                {
                    $sheet->fromArray($cars);
                });
            })->download('xlsx');
        }
        else if (Auth::user()->role_id == 3)
        {
            $cars = Car::all();
            Excel::create('cars', function ($excel) use ($cars)
            {
                $excel->sheet('Sheet 1', function ($sheet) use ($cars)
                {
                    $sheet->fromArray($cars);
                });
            })->download('xlsx');
        }
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
            $users = User::where('company_id', Auth::user()->company_id)->get();

            return view('car.create', [
                'users' => $users
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('car.create', [
                'users' => User::all()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCarRequest $request)
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
                $car = new Car;
                $car->licence_plate = $request->licence_plate;

                $user = User::find($request->user_id);
                $car->user()->associate($user);

                $car->save();

                return redirect()->route('car.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $car = new Car;
            $car->licence_plate = $request->licence_plate;

            $user = User::find($request->user_id);
            $car->user()->associate($user);

            $car->save();

            return redirect()->route('car.index');
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
        $car = Car::where('id', $id);
        return view('car.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditDeleteCarRequest|Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(EditDeleteCarRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            return view('car.edit', [
                'car' => Car::find($request->id),
                'users' => User::where('company_id', Auth::user()->company_id)->get()
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            $car = Car::find($request->id);

            return view('car.edit', [
                'car' => $car,
                'users' => User::where('company_id', $car->user->company->id)->get()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCarRequest|Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(StoreUpdateCarRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $cars = Car::whereIn('user_id', $users)->pluck('id');
            if (!in_array($request->id, $cars->toArray()) || !in_array($request->user_id, $users->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $car = Car::find($request->id);
                $car->licence_plate = $request->licence_plate;

                $user = User::find($request->user_id);
                $car->user()->associate($user);

                $car->save();

                return redirect()->route('car.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $car = Car::find($request->id);
            $car->licence_plate = $request->licence_plate;

            $user = User::find($request->user_id);
            $car->user()->associate($user);

            $car->save();

            return redirect()->route('car.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(EditDeleteCarRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');
            $cars = Car::whereIn('user_id', $users)->pluck('id');
            if (!in_array($request->id, $cars->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $car = Car::where('id', $request->id);
                $car->delete();
                Route::where('car_id', $request->id)->delete();
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $car = Car::where('id', $request->id);
            $car->delete();
            Route::where('car_id', $request->id)->delete();

            return redirect()->route('car.index');
        }
    }
}
