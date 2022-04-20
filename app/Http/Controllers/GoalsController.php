<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }
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
