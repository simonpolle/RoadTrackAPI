<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
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
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required|integer|exists:roles,id',
            'company_id' => 'required|integer|exists:companies,id',
        ];
    }
}

