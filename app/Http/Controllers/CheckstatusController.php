<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

class CheckstatusController extends Controller
{
    public static function checkstatusAdmin(){
        if(Auth::user()->us_status != 'admin')
            abort(403);

    }
    public static function checkstatusUser(){
        if(Auth::user()->us_status != 'user')
            abort(403);
    }


}
