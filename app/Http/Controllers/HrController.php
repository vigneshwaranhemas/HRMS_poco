<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrController extends Controller
{
    public function hr_dashboard()
    {
        return view('HRSS.dashboard');
    }
}
