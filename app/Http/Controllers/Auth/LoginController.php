<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
       if($user->role == 'admin' && $user->status == 1)
        {
            return redirect()->route('dashboard');
        }
        elseif($user->role == 'tutor' && $user->status == 1)
        {
            return redirect()->route('tutor_dashboard');
        }
        elseif ($user->role == 'student' && $user->status == 1) {

            return redirect()->route('student_dashboard');
        }
        else {
            Auth::logout();
            //Session::flash('error', 'You do not have permission to access this resource!');
            return back()->withErrors([ 'Your account not activate']);
          
        }
    }
      /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $role = Auth::user()->role;
        $this->guard()->logout();
        $request->session()->invalidate();
 
        if($role == 'admin'){
        return $this->loggedOut($request) ?: redirect('/admin');
        }
        if($role == 'tutor'){
            
          return $this->loggedOut($request) ?: redirect('/tutor');
        }
        else{
        return $this->loggedOut($request) ?: redirect('/student');
      }
    }
}
