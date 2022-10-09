<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Setting\SiteSetting;
use App\Models\Setting\FrontendSetting;
use Image;
use File;
use Illuminate\Support\Facades\Storage;


class SiteSettingController extends Controller
{
    public function __construct()
	{
		$this->middleware(['role:Admin']);
	}

    public function dashboard()
	{
		$setting = SiteSetting::first();

		return view('dashboard.setting.sitesetting.dashboard', compact('setting'));
	}

	public function dashboard_update(Request $request)
	{
        
		$rules = [
			'title'				=> 'required',
			'phone'				=> 'nullable',
			'email'				=> 'nullable',
			'website'			=> 'nullable',
			'address'			=> 'nullable',
			'description'		=> 'nullable',
            'logo' 				=> 'nullable|mimes:jpg,jpeg,bmp,png,gif',
            'favicon' 			=> 'nullable|mimes:jpg,jpeg,bmp,png,gif',
            'meta' 				=> 'nullable',
        ];

        $messages = [
            'title.required'    		=> 'The title field is required.',
        ];
        
        $validate = $this->validate($request, $rules, $messages);

		$input = $request->except('_token');

		

        $setting = SiteSetting::first();
        $logo_path = $setting->logo;
        $favicon_path = $setting->favicon;

		

        


		if($request->file('logo')){

			if(Storage::disk('public')->exists($logo_path)){
				Storage::disk('public')->delete($logo_path);
			}

			$path_logo = Storage::disk('public')->put('backend/setting/sitesetting', $request->file('logo'));
			
			$input['logo']= $path_logo;
		}

        if($request->file('favicon')){
			
			if(Storage::disk('public')->exists($favicon_path)){
				Storage::disk('public')->delete($favicon_path);
			}

			$path_favicon = Storage::disk('public')->put('backend/setting/sitesetting', $request->file('favicon'));
			
			$input['favicon']= $path_favicon;
		}


		try {
            $site = SiteSetting::first();
            $site->update($input);
            
			$success_msg = __('Site setting updated!');
			return redirect()->route('admin.setting.sitesetting.dashboard')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}

	}

	public function frontend(){
		$setting = FrontendSetting::first();

		return view('dashboard.setting.sitesetting.frontend', compact('setting'));
	}

	public function frontend_update(Request $request)
	{
		$rules = [
			'version'			=> 'required',
			'about'				=> 'nullable',
        ];

        $messages = [
            'version.required'    		=> 'The version field is required.',
            'about.required'    		=> 'The about field is required.',
        ];
        
        $validate = $this->validate($request, $rules, $messages);


		try {
            $site = FrontendSetting::first();
            $site->update($validate);
            
			$success_msg = __('Frontend setting updated!');
			return redirect()->route('admin.setting.sitesetting.frontend')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}
	}
}
