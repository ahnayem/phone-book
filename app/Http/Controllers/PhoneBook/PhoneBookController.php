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
    public function __construct()
	{
		$this->middleware(['role:Admin|User']);
	}

    
    public function index(Request $request)
	{

        $contacts = PhoneBook::get();

        return view('dashboard.phonebook.index', compact('contacts'));

	}

    public function create()
	{
		return view('dashboard.phonebook.create');
	}

    public function store(Request $request)
	{
		$rules = [
            'title' 			=> 'required',
            'description' 		=> 'required',
            'faq_description' 	=> 'required',
            'plan' 			    => 'required',
            'location' 			=> 'required',
            'date' 		        => 'required|date',
            'photo' 		    => 'required|mimes:jpeg,jpg,png|max:2048',
        ];

        $messages = [
            'title.required' 		    => 'The title field is required.',
            'description.required' 	    => 'The description field is required.',
            'faq_description.required' 	=> 'The faq description field is required.',
            'plan.required'   	        => 'The plan field is required',
            'location.required'   	    => 'The location field is required',
            'date.required'   	        => 'The date field is required',
            'date.date'   	            => 'The date must be date type',
            'photo.required'   	        => 'The photo field is required',
            'photo.mimes'   		    => 'The photo must be image(jpeg,jpg,png)',
            'photo.max'   		        => 'The photo must less than 2 MB',
        ];

        $validate = $this->validate($request, $rules, $messages);

        $path = Storage::disk('public')->put('backend/contact', $request->photo);

		$validate['photo'] 		 = $path;

		try {
            PhoneBook::create($validate);

			$success_msg = __('contact stored!');
			return redirect()->route('admin.contact.index')->with('success',$success_msg);

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
            'title' 			=> 'required',
            'description' 		=> 'required',
            'faq_description' 	=> 'required',
            'plan' 			    => 'required',
            'location' 			=> 'required',
            'date' 		        => 'required|date',
            'photo' 		    => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ];

        $messages = [
            'title.required' 		    => 'The title field is required.',
            'description.required' 	    => 'The description field is required.',
            'faq_description.required' 	=> 'The faq description field is required.',
            'plan.required'   	        => 'The plan field is required',
            'location.required'   	    => 'The location field is required',
            'date.required'   	        => 'The date field is required',
            'date.date'   	            => 'The date must be date type',
            'photo.mimes'   		    => 'The photo must be image(jpeg,jpg,png)',
            'photo.max'   		        => 'The photo must less than 2 MB',
        ];


        $validate = $this->validate($request, $rules, $messages);

        if($request->file('photo')){

			if(Storage::disk('public')->exists($slider->photo)){
				Storage::disk('public')->delete($slider->photo);
			}

			$path = Storage::disk('public')->put('backend/contact', $request->file('photo'));
			
			$validate['photo'] = $path;
			
		} else{
			$validate['photo'] = $slider->photo;
		}

		try {
            $contact->update($validate);
            
			$success_msg = __('contact updated!');
			return redirect()->route('admin.contact.index')->with('success',$success_msg);

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
			$success_msg = __('contact deleted!');
			return redirect()->route('admin.contact.index')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('Something went wrong!');
			return redirect()->route('admin.contact.index')->with('error',$error_msg);
		}

	}

    public function get_contact(Request $request)
	{
		$contact = PhoneBook::find($request->id);
		$date = date_create($contact->date);
        $data = [
            'title' => $contact->title,
            'location' => strip_tags($contact->location),
            'plan' => $contact->plan,
            'description' => strip_tags($contact->description),
            'date' => date_format($date, 'jS F, Y'),
        ];

        $data = json_encode($data);

        
		return $data;
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

}

