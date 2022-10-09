<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Session;

// setting model
use App\Models\Setting\SiteSetting;

// phonebook model
use App\Models\PhoneBook\PhoneBook;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $users = User::get();
        $contacts = PhoneBook::get();

        $total_user = 0;
        $total_user_this_week = 0;
        

        if(auth()->user()->hasRole('Admin')){

            $total_user = $users->where('is_admin', '0')->count();
            $total_user_this_week = $users->whereBetween('date',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            
            $total_contact = $contacts->count();
            $total_contact_added_this_week = $contacts->whereBetween('date',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            
            $latest_5 = $users->latest()->take(5);

        } else{
            $total_contact = $contacts->where('user_id', auth()->user()->id)->get();
            $total_contact_added_this_week = $contacts->where('user_id', auth()->user()->id)->whereBetween('date',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $latest_5 = $contacts->where('user_id', auth()->user()->id)->latest()->take(5);
        }

        return view('dashboard.index', compact(
            'total_user',
            'total_user_this_week',
            'total_contact',
            'total_contact_added_this_week',
            'latest_5',
        ));
        
    }


}
