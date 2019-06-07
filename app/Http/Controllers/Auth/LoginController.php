<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function loginApi(Request $request){ 
        $check = validator($request->all(),[
            'captcha'   =>'required|captcha_api:'.$request->input('key'),
            'username'  =>'required',
            'password'  =>'required'
        ]);
        if($check->passes()){
            $loginByEmail = Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')]);
            $loginByMobile = Auth::attempt(['mobile' => $request->input('username'), 'password' => $request->input('password')]);
            if($loginByEmail || $loginByMobile){
                return [
                    'access_token'=> Auth::user()->createToken(Auth::user()->id.'token')->accessToken,
                    'token_type'=> 'Bearer'
                ];
            }
            return response(['message'=>trans('messages.login_error')],400);
        }else{
            return response(['message'=>$check->errors()->first()],400);
        }
    }
}
