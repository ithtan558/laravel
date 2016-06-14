<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
/* Add by myself */
use App\AdminUsers;
use App\Http\Requests\AdminUsersRequest;
use Hash;
class Auth extends Controller
{
    public $dataPassToView = array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('admin.auth.login');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AdminUsersRequest $request)
    {
        $objAdminUsers = AdminUsers::where('email', $request->email)->first();
        if ($objAdminUsers != null) {
            if (Hash::check($request->password, $objAdminUsers->password)) {
                return redirect('admin');
            } else {
                $dataPassToView['listUsers'] = $listUsers;
                return redirect('admin/login');
            }
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
