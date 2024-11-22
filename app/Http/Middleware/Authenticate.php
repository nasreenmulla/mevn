<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function authenticate($request)
    {
        if (!Session::has('authenticated')) {
            return route('login');
        }else{
            dd(Session::has('authenticated'));
            $check = DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->where('HASH',Session::has('authenticated'))->select('*')->first();        
            dd($check); 
        }
    }
}
