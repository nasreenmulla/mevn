<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'authenticator'],function($route){

    Route::get('/', 'App\Http\Controllers\DashboardController@index');

});
Route::get('/', 'App\Http\Controllers\DashboardController@index');
Route::post('/locations/{username}', 'App\Http\Controllers\DashboardController@getLocations');
Route::post('/patients/{file}', 'App\Http\Controllers\DashboardController@getPatient');
Route::post('/appointments', 'App\Http\Controllers\DashboardController@store');
Route::post('/appointments/{appointment}', 'App\Http\Controllers\DashboardController@update');
Route::post('/appointments/delete/{appointment}', 'App\Http\Controllers\DashboardController@destroy');

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

Route::get('/login', function(){
    if (Session::has('authenticated')) {
        return redirect('/');
    }
    return view('login');
})->name('login');

Route::get('/logout',function(Request $request){
    if(!Session::has('authenticated')){
        return redirect('/login');
    }
    DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->where('HASH',Session::get('authenticated'))->delete();
    $request->session()->forget('authenticated');
    return redirect('/login');
});