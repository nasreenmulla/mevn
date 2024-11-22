<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\MEVN_USERS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'=>'required|max:255',           
            'password'=>'required|max:255'           
        ]);
    }

    public function login(Request $request){

        $data = $request->all();

        $validationResult = $this->validator($data);

        if ($validationResult->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validationResult->errors());
        }

        $user = MEVN_USERS::whereUsername($request->input('username'))
        ->where('usr_password',$request->input('password'))
        ->where('loc_name_e',$request->input('location'))
        ->first();

        if ($user !== null) {            

            $hashedPassword = Hash::make($user->password);

            
            if($request->rememberME == 'on'){
                session(['authenticated' => $hashedPassword],60 * 24 * 3);                
            }else{
                session(['authenticated' => $hashedPassword]);                
            }
            
            $max = DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->max('ID');
            
            if($max == '' || $max == null){
                 $max = 0;  
            }

            $max = $max + 1;

            if($user->type == 'USER'){
                $name = $user->username;
            }

            if($user->type == 'DOCTOR'){
                $name = $user->full_name;
            }

            DB::table('SMART.CLNC_LOGIN_SESSION_MEVN')->insert(
                [
                    'ID'=>$max,           
                    'username'=>$name,           
                    'hash'=>$hashedPassword,           
                    'LOC_NAME_E'=>$user->loc_name_e,           
                ]
            );
        }

        return redirect()->back();
    }

    /**
 * Send the response after the user was authenticated.
 *
 * @param  \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
protected function sendLoginResponse(Request $request)
{
    $request->session()->regenerate();

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'user' => $this->guard()->user(),
        ]);
    }

    return redirect()->intended('/');   

}

}
