<?php
/**
 * Created by PhpStorm.
 * User: SPLBD38
 * Date: 19/05/2017
 * Time: 14:24
 */

namespace App\Exceptions\Catchers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ValidationCatcher
{
    public function handle(Request $request, ValidationException $exception)
    {
        return Redirect::back()->withErrors($exception->validator)->withInput();
    }
}