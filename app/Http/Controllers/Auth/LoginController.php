<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/saas/create';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request)
    // {
    //     $ldap = Adldap::search()->users()->whereMail($request->email)->first();

    //     if ($ldap) {
    //         // User located.
    //         if (Adldap::auth()->attempt($ldap->getDN(), $request->password)) {
    //             // User has passed LDAP authentication.
                
    //             // Create their local account.
    //             $user = User::firstOrNew(['email' => $ldap->getEMail()]);
    
    //             // Sync user attributes.
    //             $user->name = $ldap->getCommonName();
    //             $user->email = $ldap->getEmail();
    //             $user->password = bcrypt($request->password);
    
    //             $user->save();
    
    //             Auth::login($user);
    
    //             // Logged in!
    //             return redirect($this->redirectTo);
    //         } 
    //     }
    //     Session::flash('message', 'Invalid e-mail/password'); 
    //     return view('auth.login');
    //     // User not found, return validation error.
    // }

}
