<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrController extends Controller
{
    public function hr_dashboard()
    {
        return view('HRSS.dashboard');
    }
    public function hr_goals()
    {
        return view('HRSS.goals');
    }  
    public function hr_add_goal_setting()
    {
        return view('HRSS.add_goal_setting');
    }    
    public function hr_goal_setting()
    {
        return view('HRSS.goal_setting');
    }    
}
