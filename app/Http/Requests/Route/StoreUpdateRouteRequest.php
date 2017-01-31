<?php

namespace App\Http\Requests\Route;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRouteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:cars,user_id',
            'distance_travelled' => 'required|numeric',
            'total_cost' => 'required|numeric',
        ];
    }
}
