<?php

namespace App\Http\Controllers\Models;

use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

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
            'cars' => Car::all(),
            'users' => User::all()
        ]);
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
    public function store(Request $request)
    {
        // Validate the request...
        $car = new Car;
        $car->licence_plate = $request->licence_plate;
        $car->user_id = $request->user_id;
        $car->save();

        return view('car.index', [
            'cars' => Car::all(),
            'users' => User::all()
        ]);
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
    public function edit(Request $request)
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
    public function update(Request $request)
    {
        $car = Car::find($request->id);
        $car->licence_plate = $request->licence_plate;
        $car->user_id = $request->user_id;
        $car->save();

        return view('car.index', [
            'cars' => Car::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Request $request)
    {
        $car = Car::where('id', $request->id);
        $car->delete();

        return view('car.index', [
            'cars' => Car::all(),
            'users' => User::all()
        ]);
    }
}
