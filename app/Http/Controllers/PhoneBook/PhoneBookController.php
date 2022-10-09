<?php

namespace App\Http\Controllers\PhoneBook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\PhoneBook\PhoneBook;

use Image;
use File;
use Illuminate\Support\Facades\Storage;


class PhoneBookController extends Controller
{
    
    public function index(Request $request)
	{

        $contacts = PhoneBook::where('user_id', auth()->user()->id)->latest()->get();

        return view('dashboard.phonebook.index', compact('contacts'));

	}

    public function create()
	{
		return view('dashboard.phonebook.create');
	}

    public function store(Request $request)
	{
		$rules = [
            'name' 			=> 'required',
            'email' 		=> 'required|email',
            'phone' 	    => 'required',
            'photo' 		=> 'required|mimes:jpeg,jpg,png|max:2048',
        ];

        $messages = [
            'name.required' 	=> 'The name field is required.',
            'email.required' 	=> 'The email field is required.',
            'email.email' 	    => 'The email must be an email.',
            'phone.required'   	=> 'The phone field is required',
            'photo.required'   	=> 'The photo field is required',
            'photo.mimes'       => 'The photo must be image(jpeg,jpg,png)',
            'photo.max'   		=> 'The photo must less than 2 MB',
        ];

        $validate = $this->validate($request, $rules, $messages);

        $path = Storage::disk('public')->put('backend/contact', $request->photo);

		$validate['photo'] = $path;
		$validate['user_id'] = auth()->user()->id;


		try {
            PhoneBook::create($validate);

			$success_msg = __('Contact stored!');
			return redirect()->route('phonebook.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}

	}

    public function edit($id)
	{
		$contact = PhoneBook::find($id);

		return view('dashboard.phonebook.edit',compact('contact'));
	}

    public function update(Request $request, $id)
	{
        
        $contact = PhoneBook::find($id);

        $rules = [
            'name' 			=> 'required',
            'email' 		=> 'required|email',
            'phone' 	    => 'required',
            'photo' 		=> 'nullable|mimes:jpeg,jpg,png|max:2048',
        ];

        $messages = [
            'name.required' 	=> 'The name field is required.',
            'email.required' 	=> 'The email field is required.',
            'email.email' 	    => 'The email must be an email.',
            'phone.required'   	=> 'The phone field is required',
            'photo.mimes'       => 'The photo must be image(jpeg,jpg,png)',
            'photo.max'   		=> 'The photo must less than 2 MB',
        ];


        $validate = $this->validate($request, $rules, $messages);

        if($request->file('photo')){

			if(Storage::disk('public')->exists($contact->photo)){
				Storage::disk('public')->delete($contact->photo);
			}

			$path = Storage::disk('public')->put('backend/contact', $request->file('photo'));
			
			$validate['photo'] = $path;
			
		} else{
			$validate['photo'] = $contact->photo;
		}

		try {
            $contact->update($validate);
            
			$success_msg = __('Contact updated!');
			return redirect()->route('phonebook.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->back()->with('error',$error_msg);
		}
    }


    public function destroy($id)
	{
        $getcontact = PhoneBook::find($id);
		try {
			$getcontact->delete();
			$success_msg = __('Contact deleted!');
			return redirect()->route('phonebook.index')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->route('phonebook.index')->with('error',$error_msg);
		}

	}

    public function favourite_update(Request $request)
	{

        if($request->favourite == 'Active'){
            
            PhoneBook::find($request->id)->update(['favourite' => $request->favourite]);
            $msg = __('Added to favourite');

        } else {
			PhoneBook::find($request->id)->update(['favourite' => $request->favourite]);
            $msg = __('Removed to favourite');
        }

        return response()->json(['success'=> $msg]);
        
	}

    public function favourite_list(Request $request)
	{

        $contacts = PhoneBook::where('user_id', auth()->user()->id)->where('favourite', 'Active')->latest()->get();

        return view('dashboard.phonebook.favourite', compact('contacts'));

	}

}

