<?php

namespace App\Http\Middleware;

use Closure;
use App\AdminUsers;
use Hash;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if ($request->session()->get('logged_in')) {
                return $next($request);
         }
         else if ($request->cookie('email') !== null && $request->cookie('password') !== null) {
            $email = $request->cookie('email');
            $password = $request->cookie('password');
            // Check Auth through email
            $objAdminUsers = AdminUsers::where('email', $email)->first();
            if ($objAdminUsers != null) {

                // Check Auth through password
                if (Hash::check($password, $objAdminUsers->password)) {
                    return $next($request);
                }
            }
         }

        return redirect()->route('ad_login');
    }
}
