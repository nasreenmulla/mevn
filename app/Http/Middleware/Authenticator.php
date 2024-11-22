<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class Authenticator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('authenticated')) {
            $check = DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->where('HASH',Session::get('authenticated'))->select('*')->first();  
            if(\Request::getRequestUri() != '/login'){
               return $next($request);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/login');
        }

    }
}
