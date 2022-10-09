<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use File;
use Image;
use Auth;
use DB;


use App\Models\User;


class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware(['role:Admin']);
	}

	public function index(Request $request)
	{
		$users = User::get();
        return view('dashboard.user.index', compact('users'));

	}

	public function create()
	{
		$roles = Role::pluck('name','name')->all();

		return view('dashboard.user.create',compact('roles'));
	}

	public function store(Request $request)
	{
		$rules = [
            'name' 			=> 'required',
			'email' 		=> 'required|email|unique:users,email',
			'password' 		=> 'required|min:6',
			'role' 		    => 'required',
        ];

        $messages = [
            'name.required'    		=> 'The name field is required.',
            'email.required'    	=> 'The email field is required.',
            'email.email'    		=> 'The email field must be an email.',
            'email.unique'    		=> 'The email must be unique',
            'password.required'    	=> 'The password field is required.',
            'password.min'    	    => 'The password minimum 8 digits.',
            'role.required'    	    => 'The role field is required.',
        ];

        $validate = $this->validate($request, $rules, $messages);

        if($request->role == 'User'){
            $is_admin = '0';
            $role_id = 2;

        } elseif($request->role == 'Admin'){
            $is_admin = '1';
            $role_id = 1;
        }

		$password = Hash::make($request->password);


		try {
			$user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_admin' => $is_admin,
                'password' => $password,
            ]);

			$user->assignRole($role_id);

			$success_msg = __('User created!');
			return redirect()->route('admin.user.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}

	}


	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::pluck('name','name')->all();
        $userRole = $user->getRoleNames()->first();
        
		return view('dashboard.user.edit',compact('user', 'roles','userRole'));
	}

	public function update(Request $request, $id)
	{
        $user = User::find($id);

        if($user->email == $request->email){
            $rules = [
                'name' 			=> 'required',
                'password' 		=> 'required|min:6',
                'role' 		    => 'required',
            ];
    
            $messages = [
                'name.required'    		=> 'The name field is required.',
                'password.required'    	=> 'The password field is required.',
                'password.min'    	    => 'The password minimum 8 digits.',
                'role.required'    	    => 'The role field is required.',
            ];

        } else {
            $rules = [
                'name' 			=> 'required',
                'email' 		=> 'required|email|unique:users,email',
                'password' 		=> 'required|min:6',
                'role' 		    => 'required',
            ];
    
            $messages = [
                'name.required'    		=> 'The name field is required.',
                'email.required'    	=> 'The email field is required.',
                'email.email'    		=> 'The email field must be an email.',
                'email.unique'    		=> 'The email must be unique',
                'password.required'    	=> 'The password field is required.',
                'password.min'    	    => 'The password minimum 8 digits.',
                'role.required'    	    => 'The role field is required.',
            ];
        }

		

        $validate = $this->validate($request, $rules, $messages);

        if($request->role == 'User'){
            $is_admin = '0';
            $role_id = 2;

        } elseif($request->role == 'Admin'){
            $is_admin = '1';
            $role_id = 1;
        }

		$password = Hash::make($request->password);
        
        $input = $request->all();

        $input['password'] = $password;

		try {
			$user->update($input);
			DB::table('model_has_roles')->where('model_id',$id)->delete();
			$user->assignRole($role_id);

            $success_msg = __('User edited!');
			return redirect()->route('admin.user.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}

	}

	public function destroy($id)
	{
		$alluser = User::all();
		$countalluser = $alluser->count();

		if(auth()->user()->id == $id){
			$warning_msg = __('You cannot delete by yourself!');
			return redirect()->route('admin.user.index')->with('warning',$warning_msg);
		}

		if ($countalluser <= 1) {
			$warning_msg = __('Last user cannot be deleted!');
			return redirect()->route('admin.user.index')->with('warning',$warning_msg);
		}else{
			$getuser = User::find($id);
			if(!empty($getuser->profile_photo_path)){
				$image_path = 'storage/'.$getuser->profile_photo_path;
				if(File::exists($image_path)) {
				    File::delete($image_path);
				}
			}
			try {
				User::find($id)->delete();
				$success_msg = __('User deleted!');
				return redirect()->route('admin.user.index')->with('success',$success_msg);
			} catch (Exception $e) {
				$error_msg = __('Something went wrong!');
				return redirect()->route('admin.user.index')->with('error',$error_msg);
			}
		}

	}

}
