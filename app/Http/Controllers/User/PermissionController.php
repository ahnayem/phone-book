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

class PermissionController extends Controller
{
	public function __construct()
	{
		$this->middleware(['role:Admin']);
	}

    public function index(Request $request)
	{

        $permissions = Permission::get();

        return view('dashboard.user.permission.index', compact('permissions'));

	}

    public function create()
	{
		return view('dashboard.user.permission.create');
	}

    public function store(Request $request)
	{
		$rules = [
            'name' 			=> 'required|unique:permissions,name',
        ];

        $messages = [
            'name.required'    		=> 'The name field is required.',
            'name.unique'    		=> 'The name must be unique',
        ];

        $validate = $this->validate($request, $rules, $messages);


		try {

            Permission::create([
				'name' => $request->name
			]);

			$success_msg = __('Permision created!');
			return redirect()->route('admin.user.permission.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}

	}

    public function edit($id)
	{
		$permission = Permission::find($id);

		return view('dashboard.user.permission.edit',compact('permission'));
	}

    public function update(Request $request, $id)
	{
        $permission = Permission::find($id);

        if($permission->name == $request->name){
            $rules = [
                'name' 			=> 'required',
            ];
    
            $messages = [
                'name.required'    		=> 'The name field is required.',
            ];

        } else {
            $rules = [
                'name' 			=> 'required|unique:permissions,name',
            ];
    
            $messages = [
                'name.required'    		=> 'The name field is required.',
                'name.unique'    		=> 'The name must be unique',
            ];
        }


        $validate = $this->validate($request, $rules, $messages);

        $input = $request->all();

		try {
            $permission->update($input);
            
			$success_msg = __('Permission updated!');
			return redirect()->route('admin.user.permission.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}
    }


    public function destroy($id)
	{
		$allpermission = Permission::all();
		$countallpermission = $allpermission->count();

        $getpermission = Permission::find($id);

        $user = User::find(auth()->user()->id);

		if ($countallpermission <= 1) {
			$warning_msg = __('Last permission cannot be deleted!');
			return redirect()->route('admin.user.permission.index')->with('warning',$warning_msg);
		}else{
			
			try {
				$getpermission->delete();
				$success_msg = __('Permission deleted!');
				return redirect()->route('admin.user.permission.index')->with('success',$success_msg);
			} catch (Exception $e) {
				$error_msg = __('Something went wrong!');
				return redirect()->route('admin.user.permission.index')->with('error',$error_msg);
			}
		}

	}
}
