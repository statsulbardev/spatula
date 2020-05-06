<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Statsulbar\BPSAuth\Facades\BPSAuth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // if(Auth::loginUsingId(1)) return $this->sendLoginResponse($request);

        if(BPSAuth::login($request->username, $request->password)) {
            $bps_id = BPSAuth::getBpsId();

            $profile = BPSAuth::getProfil($bps_id);

            $user = User::where('bps_id', $bps_id)->first();

            if(!empty($user)) {
                try {
                    $user->update([
                        'name'        => $profile['nama'],
                        'email'       => $profile['email'],
                        'bps_id'      => $bps_id,
                        'employee_id' => $profile['nippanjang'],
                        'photo_path'  => $profile['urlfoto'],
                    ]);
                } catch(\Exception $e) {
                    return abort(500);
                }

                if(Auth::loginUsingId($user->id)) return $this->sendLoginResponse($request);
            } else {
                return abort(403);
            }
        } else {
            return abort(401);
        }
    }
}
