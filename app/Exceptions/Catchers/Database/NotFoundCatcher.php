<?php
/**
 * Created by PhpStorm.
 * User: SPLBD38
 * Date: 19/05/2017
 * Time: 14:24
 */

namespace App\Exceptions\Catchers\Database;


use App\Exceptions\Database\NotFoundException;
use Illuminate\Http\Request;

class NotFoundCatcher
{
    public function handle(Request $request, NotFoundException $exception)
    {
        return response()->json([
            'message' => $exception->getMessage(),
            'statuscode' => 404
        ], 404);
    }
}