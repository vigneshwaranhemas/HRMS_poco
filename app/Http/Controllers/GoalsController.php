<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoalsController extends Controller
{
    
    public function goals()
    {
        return view('goals.index');
    }  
    public function add_goal_setting()
    {
        return view('goals.add_goal_setting');
    }    
    public function goal_setting()
    {
        return view('goals.goal_setting');
    }  
    
}
