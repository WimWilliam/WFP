<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    //  */
    // protected $redirectTo = '/home';

    //Ketika login akan diarahkan ke halaman type
    protected $redirectTo = '/type';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function authenticated(Request $request, $user)
    {
        if ($user->role == 'staff') {
            return redirect()->route('dashboard'); 
        } elseif ($user->role == 'pembeli') {
            return redirect()->route('laralux.index'); 
        } elseif ($user->role == 'owner') {
            return redirect()->route('owner.index'); 
        }
    }
}
