<?php

namespace App\Http\Controllers\Models\Api;

use App\Exceptions\DefaultException;
use App\Exceptions\Entities\Cars\CarNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\route\StoreUpdateRouteRequest;
use App\Models\Car;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class CarController extends Controller
{
    /**
     * Display a car by id.
     *
     * @param $id
     * @return Response
     */
    public function getById($id)
    {
        $cars = Car::where('id', '=', $id)->get();

        if (!$cars->isEmpty()) {
            return $cars->first();
        }

        throw new CarNotFoundException("We could not find the car with id:" . $id . ".");
    }
}
