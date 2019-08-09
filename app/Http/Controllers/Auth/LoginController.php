<?php

namespace App\Http\Controllers\Auth;

use App\Error;
use App\Exceptions\ValidateException;
use App\Http\Controllers\Controller;
use App\Models\SmsCode;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Jcove\Restful\Restful;

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
    use Restful;
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
        $this->redirectTo                   =   url()->previous();
    }
    public function login(Request $request)
    {
        $code                               =   $request->code;
        if($code){
            return $this->codeLogin($request);
        }
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return $this->respond($user);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function showLoginForm()
    {
        $redirectUrl                                    =   request()->redirct_url;
        $this->data['title']                            =   trans('message.user_login');
        $this->data['redirect_url']                     =   $redirectUrl ? :url()->previous();
        return respond($this->data);
    }

    protected function username(){
        return 'mobile';
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws ValidateException
     */
    public function codeLogin($request){
        $mobile                         =   $request->mobile;
        $code                           =   $request->code;
        if($mobile){

            $smsCode                    =   SmsCode::getCode($mobile);
            if(null==$smsCode){
                throw new ValidateException(trans('system.sms_code_error'),Error::sms_error);
            }
            if($smsCode->code!=$code){
                throw new ValidateException(trans('system.sms_code_error'),Error::sms_error);
            }

            SmsCode::useCode($mobile);
            $user                       =   User::where('mobile',$mobile)->first();
            if($user){
                Auth::login($user);
                $this->data                     =   $user;
                return $this->respond($this->data);
            }else{
                throw new ValidateException(trans('auth.user_not_exist'),Error::user_not_exist);
            }
        }else{
            throw new ValidateException(trans('auth.mobile_error'),Error::mobile_error);
        }


    }
}
