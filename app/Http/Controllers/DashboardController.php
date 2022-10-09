<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Session;

// setting model
use App\Models\Setting\SiteSetting;

// category model
use App\Models\Category\EventCategory;

// event model
use App\Models\Event\OrganizeEvent;

// gallery model
use App\Models\Event\Gallery;

// contact model
use App\Models\Event\Contact;

// slider model
use App\Models\Event\Slider;

// speaker model
use App\Models\Event\KeyNoteSpeaker;

// testimonial model
use App\Models\Event\Testimonial;

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
        $total_category = EventCategory::count();
        $total_event = OrganizeEvent::count();
        $total_gallery = Gallery::count();
        $total_contact = Contact::count();
        $total_speaker_member = KeyNoteSpeaker::count();
        $events = OrganizeEvent::whereBetween('date',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        return view('dashboard.index', compact(
            'events',
            'total_category',
            'total_event',
            'total_gallery',
            'total_contact',
            'total_speaker_member',
        ));
        
    }


}
