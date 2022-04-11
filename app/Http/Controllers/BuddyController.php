<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuddyController extends Controller
{
    public function buddy_dashboard()
    {
        $current_date = date("m-d");
        $todays_birthdays = DB::table('candidate_details')->select('*')->where('candidate_dob', 'LIKE', '%'.$current_date.'%')->get();                                        
        return view('buddy.dashboard', ['todays_birthdays'=> $todays_birthdays]);
    }

    public function buddy_info()
    {
        //    $sess_info=Session::get("session_info");
        //    $id=$sess_info["empID"];
        //    $candidate_info=$this->brep->get_candidate_info($id);
        //    return view('buddy.index')->with('candidate_info',$candidate_info);
           return view('buddy.index');
    }      

}
