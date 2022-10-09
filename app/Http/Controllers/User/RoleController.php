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

class RoleController extends Controller
{
	public function __construct()
	{
		$this->middleware(['role:Admin']);
	}
	
    public function index(Request $request)
	{
		// $roles = Role::pluck('name','name')->all();

        $roles = Role::get();

        return view('dashboard.user.role.index', compact('roles'));

	}

    public function create()
	{
		return view('dashboard.user.role.create');
	}

    public function store(Request $request)
	{
		$rules = [
            'name' 			=> 'required|unique:roles,name',
        ];

        $messages = [
            'name.required'    		=> 'The name field is required.',
            'name.unique'    		=> 'The name must be unique',
        ];

        $validate = $this->validate($request, $rules, $messages);


		try {
			$roleAdmin = Role::create(['name' => $request->name, 'guard_name' => 'web']);

			$success_msg = __('Role created!');
			return redirect()->route('admin.user.role.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}

	}

    public function edit($id)
	{
		$role = Role::find($id);

		return view('dashboard.user.role.edit',compact('role'));
	}

    public function update(Request $request, $id)
	{
        $role = Role::find($id);

        if($role->name == $request->name){
            $rules = [
                'name' 			=> 'required',
            ];
    
            $messages = [
                'name.required'    		=> 'The name field is required.',
            ];

        } else {
            $rules = [
                'name' 			=> 'required|unique:roles,name',
            ];
    
            $messages = [
                'name.required'    		=> 'The name field is required.',
                'name.unique'    		=> 'The name must be unique',
            ];
        }


        $validate = $this->validate($request, $rules, $messages);

        $input = $request->all();

		try {
            $role->update($input);
            
			$success_msg = __('Role updated!');
			return redirect()->route('admin.user.role.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}
    }


    public function destroy($id)
	{
		$allrole = Role::all();
		$countallrole = $allrole->count();

        $getrole = Role::find($id);

        $user = User::find(auth()->user()->id);

		if($user->getRoleNames()->first() == $getrole->name){
			$warning_msg = __('You cannot your current role!');
			return redirect()->route('admin.user.role.index')->with('warning',$warning_msg);
		}

		if ($countallrole <= 1) {
			$warning_msg = __('Last role cannot be deleted!');
			return redirect()->route('admin.user.role.index')->with('warning',$warning_msg);
		}else{
			
			try {
				$getrole->delete();
				$success_msg = __('Role deleted!');
				return redirect()->route('admin.user.role.index')->with('success',$success_msg);
			} catch (Exception $e) {
				$error_msg = __('Something went wrong!');
				return redirect()->route('admin.user.role.index')->with('error',$error_msg);
			}
		}

	}

	public function set_permission($id) {

		$role = Role::find($id);
		$rolepermissions = $role->permissions->pluck('name');

		$allpermission = Permission::all();

		return view('dashboard.user.role.set_permission',compact('rolepermissions', 'allpermission', 'role'));
	}

	public function set_permission_update(Request $request, $id) 
	{
		$permissions = $request->permissions;
		try{
			$role = Role::find($id);
			$role->syncPermissions($permissions);

			$success_msg = __('Permission set!');
				return redirect()->route('admin.user.role.index')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->route('admin.user.role.index')->with('error',$error_msg);
		}

	}

}
