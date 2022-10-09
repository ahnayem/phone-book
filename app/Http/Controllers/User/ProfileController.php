<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;
use Image;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        $user= User::find(auth()->user()->id);

        return view('dashboard.profile', compact('user'));
    }


    public function update_profile(Request $request)
	{
        try {
            $input      = $request->all();
            $user    = User::find(auth()->user()->id);

            

            if($request->file('profile_photo_path')){

                $path = Storage::disk('public')->put('backend/profile_photo', $request->file('profile_photo_path'));
                
                $input['profile_photo_path']= $path;
            }

			$user->update($input);

			$success_msg = __('Profile updated!');
			return redirect()->route('admin.profile')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->route('admin.profile')->with('error',$error_msg);

            // return response()->json(['error'=>$error_msg]);
		}
	}


    public function update_password(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        /*
        * Validate all input fields
        */
        $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'min:6|same:password',
        ]);


        if ($request->password == $request->confirm_password) {

            // $password = Hash::make($request->password);

            // dd($request->user());

            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
            


            $success_msg = __('Password updated!');
            return redirect()->back()->with('success',$success_msg);

        } else {
            $error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
        }

    }
}
