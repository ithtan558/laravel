<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Language extends Controller
{
    public function index()
	{
	    Session::set('locale', Input::get('locale'));
	    return Redirect::back();
	}
}
