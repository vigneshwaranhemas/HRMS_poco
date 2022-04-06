<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuddyController extends Controller
{
    public function buddy_dashboard()
    {
        return view('buddy.dashboard');
    }
}
