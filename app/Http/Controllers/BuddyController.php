<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuddyController extends Controller
{
    public function buddy_dashboard()
    {
        return view('buddy.dashboard');
    }

    public function buddy_info()
    {
        //    $sess_info=Session::get("session_info");
        //    $id=$sess_info["empID"];
        //    $candidate_info=$this->brep->get_candidate_info($id);
        //    return view('buddy.index')->with('candidate_info',$candidate_info);
           return view('buddy.index');
    }
    public function buddy_goals()
    {
        return view('buddy.goals');
    }  
    public function buddy_add_goal_setting()
    {
        return view('buddy.add_goal_setting');
    }    
    public function buddy_goal_setting()
    {
        return view('buddy.goal_setting');
    }    

}
