<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin_dashboard()
    {
        return view('admin.dashboard');
    } 
    public function admin_goals()
    {
        return view('admin.goals');
    }  
    public function admin_add_goal_setting()
    {
        return view('admin.add_goal_setting');
    }    
    public function admin_goal_setting()
    {
        return view('admin.goal_setting');
    }    
    public function holidays()
    {
        return view('admin.holidays');
    }
    public function events()
    {                
        $candicate_details = DB::table('candidate_details')->get();
        $event_categories_data = DB::table('event_categories')->get();
        $event_types_data = DB::table('event_types')->get();
        return view('event-calendar.index', ['candicate_details'=> $candicate_details, 'event_categories_data'=> $event_categories_data, 'event_types_data'=> $event_types_data]);    
    }
}
