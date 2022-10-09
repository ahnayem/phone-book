<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\Support\Renderable;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\App;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_go(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required',
            'remember'              => 'nullable',
            // 'g-recaptcha-response'  => 'required'
        ];

        $messages = [
            'email.required'        => __('The email field is required'),
            'email.email'           => __('The email must be a valid email'),
            'password.required'     => __('The password field is required'),
        ];


        $data = $this->validate($request, $rules, $messages);


        if (!isset(request()->remember)) {
            $data['remember'] = "off";
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {

            // return redirect()->intended('/admin/dashboard');
            return redirect()->intended('/dashboard');

            // // use with active status
            // if (auth()->user()->status == 'Active') {
            //     return redirect()->intended('/admin/dashboard');
            // }else{
            //     auth()->logout();
            //     $error_msg = __('admin::auth.profile.message.deactivated.error');
            //     return redirect()->back()->with('error', $error_msg);
            // }
        }else{
            $error_msg = __('Creadentials mismatch!');
            return redirect()->back()->with('error', $error_msg);
        }

    }



    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
