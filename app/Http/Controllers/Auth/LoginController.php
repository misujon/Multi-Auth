<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(Request $request, $user)
    {
        if (!$user)
        {
            Auth::logout();
            return redirect('/login')->with('msg-error', 'User not found!');
        }
        if ($user->status !== "active") {
            Auth::logout();
            return redirect('/login')->with('msg-error', 'Sorry you are not active yet. Please contact admin.');
        }
    }

    public function redirectTo()
    {
        switch (Auth::user()->role_id){
            case 1:
                $this->redirectTo = '/admin';
                return $this->redirectTo;
                break;

            case 2:
                if (Auth::user()->status == 'active')
                {
                    $this->redirectTo = '/manager';
                    return $this->redirectTo;
                }
                else
                {
                    $this->redirectTo = '/login';
                    return $this->redirectTo;
                }
                break;

            case 3:
                if (Auth::user()->status == 'active')
                {
                    $this->redirectTo = '/user';
                    return $this->redirectTo;
                }
                else
                {
                    $this->redirectTo = '/login';
                    return $this->redirectTo;
                }
                break;

            default:
                $this->redirectTo = '/error';
                return $this->redirectTo;
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
