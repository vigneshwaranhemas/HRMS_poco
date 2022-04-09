<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function candidate_dashboard()
    {
        return view('candidate.dashboard');
    }
    public function candidate_goals()
    {
        return view('candidate.goals');
    }  
    public function candidate_add_goal_setting()
    {
        return view('candidate.add_goal_setting');
    }    
    public function candidate_goal_setting()
    {
        return view('candidate.goal_setting');
    }    
}
