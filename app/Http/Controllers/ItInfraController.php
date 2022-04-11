<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItInfraController extends Controller
{
    public function index()
    {
        $current_date = date("m-d");
        $todays_birthdays = DB::table('candidate_details')->select('*')->where('candidate_dob', 'LIKE', '%'.$current_date.'%')->get();                                        
        return view('ItInfra.dashboard', ['todays_birthdays'=> $todays_birthdays]);
    }

    public function EmailIdCreation()
    {
        return view('ItInfra.EmailIdCreation');
    }


}
