<?php 
namespace App\Libraries;

use Illuminate\Http\Request;
use App\Http\Requests;
use Cookie;
class PublicFunction
{

	/**
     * Set session for array.
     *
     * @param  array  $array
     * @return \Illuminate\Http\Response
     */
	public static function set_session(Request $request, $array = array())
	{
		if (is_array($array)) {
			foreach ($array as $key => $value) {
				$request->session()->put($key, $value);
			}
		}
	}

	/**
     * Set cookie and time for array.
     *
     * @param  array  $array, $int $time (Default null and unit's munite)
     * @return \Illuminate\Http\Response
     */
	public static function set_cookie(Request $request, $array = array(), $time = 0)
	{
		if (is_array($array)) {
			if ($time == 0) {
				foreach ($array as $key => $value) {
	                Cookie::queue(Cookie::forever($key, $value));
				}
			} else {
				foreach ($array as $key => $value) {
	                Cookie::queue($key, $value, $time);
				}
			}
		}
	}
}