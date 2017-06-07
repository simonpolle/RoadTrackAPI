<?php

namespace App\Http\Requests\Cost;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCostRequest extends FormRequest
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
            'name' => 'required|alpha_spaces',
            'cost' => 'required|numeric',
            'company_id' => 'integer|exists:companies,id',
        ];
    }
}

