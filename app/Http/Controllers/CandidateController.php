<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function candidate_dashboard()
    {
        return view('candidate.dashboard');
    }
    public function profile(){
        return view('candidate.profile');
        }
}
