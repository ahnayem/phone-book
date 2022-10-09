<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Models\User;

class RegisterController extends Controller
{
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


    public function register(){
        return view('auth.register');
    }
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(Request $request)
    {

        $rules = [
            'name' 			=> 'required|string|max:255',
            'email' 		=> 'required|email|unique:users|max:255',
            'password' 		=> 'required|string|confirmed|max:255',
        ];

        $messages = [
            'name.required' 	=> 'The name field is required.',
            'name.string' 		=> 'The name field must be string.',
            'name.max' 		    => 'The name field must less than 255 char.',
            'email.required' 	=> 'The email field is required.',
            'email.string' 		=> 'The email field must be string.',
            'email.unique' 		=> 'This email already taken.',
            'email.max' 		=> 'The email field must less than 255 char.',
            'password.required' => 'The password field is required.',
            'password.string' 	=> 'The password field must be string.',
            'password.confirmed'=> 'The password and confirm password should be same.',
            'password.max' 		=> 'The password field must less than 255 char.',
        ];

        $validate = $this->validate($request, $rules, $messages);


        try {
			User::create([
                'name' => $validate['name'],
                'email' => $validate['email'],
                'password' => Hash::make($validate['password']),
            ]);
            
			$success_msg = __('Registration successful');
			return redirect()->route('auth.login')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}
    }
}
