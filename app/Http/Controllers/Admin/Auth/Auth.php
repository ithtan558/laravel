<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
/* Add by myself */
use App\AdminUsers;
use App\Http\Requests\AdminUsersRequest;
use Illuminate\Http\Response;
use Hash;
use App\Libraries\PublicFunction;
use Mail;
use Lang;
use Validator;
class Auth extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->get('role_id')) {
            return redirect()->route('user_list');
        } else if ($request->cookie('email') !== null && $request->cookie('password') !== null) {
            $email = $request->cookie('email');
            $password = $request->cookie('password');
            // Check Auth through email
            $objAdminUsers = AdminUsers::where('email', $email)->first();
            if ($objAdminUsers != null) {

                // Check Auth through password
                if (Hash::check($password, $objAdminUsers->password)) {
                    return redirect('admin/users/list');
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
    public function login(AdminUsersRequest $request)
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
                    $arrayCookie = array();
                    $arrayCookie['email'] = $email;
                    $arrayCookie['password'] = $password;
                    PublicFunction::set_cookie($request,$arrayCookie, LIMIT_COOKIE_LOGIN);
                }

                // Create session email and password
                $arraySession = array();
                $arraySession['logged_in'] = TRUE;
                $arraySession['role_id'] = $objAdminUsers->role_id;
                $arraySession['id'] = $objAdminUsers->id;
                PublicFunction::set_session($request,$arraySession);

                // Redirect to the name router is defined before
                return redirect()->route('user_list');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        \Cookie::queue(
            \Cookie::forget('email')
        );
        \Cookie::queue(
            \Cookie::forget('password')
        );
        return redirect()->route('ad_login');
    }


    /**
     * Form post email to reset password for admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->route('ad_email')
                        ->withErrors($validator)
                        ->withInput();
        }
        // Check method
        if ($request->method() === 'POST') {
            $email = $request->email;
            // Check exits email in database
            $objAdminUsers = AdminUsers::where('email', $email)->first();
            if ($objAdminUsers != null) {
                $rand_temp = md5(uniqid(rand(),TRUE));
                $full_email=explode('@', $email);
                $first_email=$full_email[0];
                $last_email=$full_email[1];
                $data = array(
                    'name' => $objAdminUsers->name,
                    'forgot_url' => env('APP_URL').'/'.Lang::getLocale().'/admin/reset-password/'.$first_email.'/'.$last_email.'/'.$rand_temp,
                    'site_name' => "Laravel dev"
                );
                // Check send mail success
                if (Mail::send('email_templates.forgotPassword', $data, function ($m) use ($objAdminUsers) {
                    $m->from('no-reply@laravel.dev', 'Active verification');
                    $m->to($objAdminUsers->email, $objAdminUsers->name)->subject('Workspharma Team: New Password for Login');
                })) {
                    // Update key rand for forgot
                    AdminUsers::where('email', $email)
                              ->update(['remember_token' => $rand_temp]);
                    $request->session()->flash('success', 'Task was successful!');
                    return redirect()->route('ad_email');
                }
            } else {
                // Add messageBag to validation
                $validator->getMessageBag()->add('email', 'Email not found');
                return redirect()->route('ad_email')
                            ->withErrors($validator)
                            ->withInput();
                }
            
        } else {
            abort(403, 'Unauthorized action.');
        }
        
    }

    /**
     * Show the form reset password for admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {
        $dataPassToView['email'] = $request->segment(4).'@'.$request->segment(5);
        $dataPassToView['first_email'] = $request->segment(4);
        $dataPassToView['last_email'] = $request->segment(5);
        $dataPassToView['token'] = $request->segment(6);
        return view('admin.auth.passwords.reset', $dataPassToView);   
    }

    /**
     * Form reset password for admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        // get 3 paramester and assign to array
        $arrayParamester = array(
            'first_email' => $request->segment(4),
            'last_email' => $request->segment(5),
            'rand_key' => $request->segment(6)
        );
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',

        ]);
        if ($validator->fails()) {
            return redirect()->route('ad_reset', $arrayParamester)
                        ->withErrors($validator)
                        ->withInput();
        }
        // Check method
        if ($request->method() === 'POST') {
            // Check token exits in key_forgot of user
            $token = $request->token;
            $email = $request->email;
            $password = $request->password;
            $user = AdminUsers::where('remember_token', '=', $token)
                              ->where('email', '=', $email)->first();
            if (count($user) > 0) {
                $updateUser = AdminUsers::find($user->id);
                $updateUser->password = bcrypt($password);
                $updateUser->remember_token = '';
                $updateUser->save();
                $request->session()->flash('success', 'Your password changed, please login by new password.');
                return redirect()->route('ad_reset', $arrayParamester);
            } else {
                $request->session()->flash('error', 'Token not found, please check again!');
                return redirect()->route('ad_reset', $arrayParamester);
            }
        } else {
            abort(403, 'Unauthorized action.');
        }  
    }

    /**
     * Post the form reset password for admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function email()
    {
        return view('admin.auth.passwords.email');
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
