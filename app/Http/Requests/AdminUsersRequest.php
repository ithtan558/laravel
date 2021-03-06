<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminUsersRequest extends Request
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
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email is requerid',
            'email.email' => 'Email is not correct',
            'password.required' => 'Password is requerid',
            'password.min' => 'Password min 6 chacracter',
        ];
    }
}
