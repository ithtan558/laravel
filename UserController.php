<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\LoginRequest;
use App\Http\Requests\Admin\Users\CreateUserRequest;

use App\Admin;
class UserController extends Controller
{
	public function __construct()
    {
    }
    /********Show user list*******/
    public function getIndex(){
        $obj = new Admin;
        $user = $obj->all();
        return view('admin.users.index',['users' => $user]);
    }
	public function getLogin(){
		return view('admin.users.register');
	}
    public function postLogin(LoginRequest $request){
    	$login = array(
    		'username' => $request->username,
    		'password' => $request->password
    		);
    	if($this->auth->attemp($login)){
    		return redirect()->route('admin.users.index');
    	}else{
    		return redirect()->back();
    	}
    }
    public function getCreate(){
		return view('admin.users.create');
	}
    public function postCreate(CreateUserRequest $request){
        $obj = new Admin;
        $obj->full_name = $request->full_name;
        $obj->username = $request->username;
        $obj->email = $request->email;
        $obj->password = bcrypt($request->password);
        $obj->status  = '1';
        $obj->remember_token = 'abc';
        $obj->save();
    	return "sdfs";
    }
    public function getEdit($id){
        $data = Admin::findOrFail($id)->toArray();
        return view('admin.users.edit',compact('data'));
    }
    public function postEdit(CreateUserRequest $request, $id){
        dd($id);
        $obj = Admin::findOrFail($id);
        $obj->update($request->all());
        if (is_null($obj))
        {
            return 'dfsd';
        }
        return view('admin.users.edit');
    }
}
