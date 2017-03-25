<?php

namespace App\Http\Controllers\Models;

use App\Http\Requests\Car\StoreUpdateCarRequest;
use App\Http\Requests\Route\EditDeleteRouteRequest;
use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
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
        return view('car.index', [
            'cars' => Car::all()
        ]);
    }

    public function pdf(Request $request)
    {
        $cars = Car::all();
        view()->share('cars', $cars);

        if ($request->has('download')) {
            $pdf = PDF::loadView('car.pdf');
            return $pdf->download('car.pdf');
        }

        return view('company.index');
    }

    public function excel()
    {
        $cars = Car::all();
        Excel::create('cars', function ($excel) use ($cars) {
            $excel->sheet('Sheet 1', function ($sheet) use ($cars) {
                $sheet->fromArray($cars);
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
        return view('car.create', [
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCarRequest $request)
    {
        // Validate the request...
        $car = new Car;
        $car->licence_plate = $request->licence_plate;
        $car->user_id = $request->user_id;
        $car->save();

        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(EditDeleteRouteRequest $request)
    {
        return view('car.edit', [
            'car' => Car::find($request->id),
            'users' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCarRequest $request)
    {
        $car = Car::find($request->id);
        $car->licence_plate = $request->licence_plate;
        $car->user_id = $request->user_id;
        $car->save();

        return redirect()->route('car.index');
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
        $car = Car::where('id', $request->id);
        $car->delete();
        Route::where('car_id', $request->id)->delete();

        return redirect()->route('car.index');
    }
}
