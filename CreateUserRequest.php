<?php
namespace App\Http\Requests\Admin\users;
use App\Http\Requests\Request;
class CreateUserRequest extends Request
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
        $group = ($this->segment(3));
dd($this->method());
        switch ($group) {
            case 'edit':
                return [
                    'full_name' => 'required',
                    "email" => "required|email|unique:admins,email,4",
                ];
                break;
            case 'add':
                return [
                    'full_name' => 'required',
                    'username' => 'required|max:30|unique:admins',
                    'email' => 'required|email|max:255|unique:admins',
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation'  =>  'required|min:8',
                ];
                break;            
            default:
                break;
        }
        
    }
     public function messages(){
        return [
            'username.required' => 'The username field is required.',
            'username.unique' => 'Da ton tai.',
            'full_name.required' => 'The Full name field is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required',
            'password_confirmation.required'  =>  'The password confirmation is required',
            'password_confirmation.confirmed'  =>  'The password confirmation is not',
        ];
    }
}
