<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


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
    //Modification for the router after make login

    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Return the desired route with the user parameter
        // return route('dashboard.client', ['user' => $user]);
        // Check if the user has the 'admin' role
        if ($user->hasRole('admin')) {
        // Redirect admin to the admin dashboard
            return route('newadmin.index');
        } elseif ($user->hasRole('customer')) {
            // Redirect customer to the client dashboard
            return route('dashboard.client', ['user' => $user]);
        } else {
            // If the user doesn't have any specific role, you can provide a default route
            return route('inicio');
        }
    }

    //For the Logout
    protected function loggedOut()
    {
        return redirect('/login');
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
