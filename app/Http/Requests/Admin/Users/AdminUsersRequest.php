<?php

namespace App\Http\Requests\Admin\Users;

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
            'email' => 'required|email|unique:admin_users',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'name' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email is requerid',
            'email.email' => 'Email is not correct',
            'password.required' => 'Password is requerid',
            'password.min' => 'Password min 6 chacracter',
            'role_id.required' => 'Type user is requerid',
            'name.required' => 'Full name is requerid',
        ];
    }
}
