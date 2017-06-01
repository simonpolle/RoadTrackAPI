<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCompanyRequest extends FormRequest
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
            'name' => 'required',
            'street' => 'required',
            'street_number' => 'required|numeric',
            'postal_code' => 'required|digits:4',
            'country' => 'required',
            'vat_number' => 'required',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
