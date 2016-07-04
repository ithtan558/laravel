<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
/* Add by myself */
use App\AdminUsers;
use App\Http\Requests\Admin\Auth\AdminAuthRequest;
use Hash;
class Auth extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->get('role_id') == 1) {
            return redirect('admin/users/list');
        } else if ($request->cookie('email') !== null && $request->cookie('password') !== null) {
            $email = $request->cookie('email');
            $password = $request->cookie('password');
            // Check Auth through email
            $objAdminUsers = AdminUsers::where('email', $email)->first();
            if ($objAdminUsers != null) {

                // Check Auth through password
                if (Hash::check($password, $objAdminUsers->password)) {
                    return redirect()->to('list_users');
                }
            }

        } else {
            return View('admin.auth.login');
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AdminAuthRequest $request)
    {
        // Check isset cookie email and password
        $email = $request->email;
        $password = $request->password;

        // Check Auth through email
        $objAdminUsers = AdminUsers::where('email', $email)->first();
        if ($objAdminUsers != null) {

            // Check Auth through password
            if (Hash::check($password, $objAdminUsers->password)) {

                // Check remember me
                if ($request->remember) {
                    $response = new \Illuminate\Http\Response();
                    $response->withCookie('email', $email, 60);
                    $response->withCookie('password', $password, 60);
                    return $response;
                }

                // Create session email and password
                $request->session()->put('email', $email);
                $request->session()->put('password', $password);
                $request->session()->put('role_id', $objAdminUsers->role_id);
                return redirect()->to('list_users');
            } else {
                $dataPassToView['message'] = trans('admin/auth.login_fault');
                return view('admin.auth.login', $dataPassToView);
            }
        } else {
            $dataPassToView['message'] = trans('admin/auth.login_fault');
            return view('admin.auth.login', $dataPassToView);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
