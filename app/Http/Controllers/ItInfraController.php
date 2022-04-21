<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class ItInfraController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
        // $this->middleware('is_itinfra');
    }
    public function index()
    {
        //Birthday card
        $current_date = date("d-m-Y");
        $date = Carbon::createFromFormat('d-m-Y', $current_date);   
        $result = $date->format('F');
        $monthName = substr($result, 0, 3); 
        $dt = $date->format('d');
        $tdy = $dt."-".$monthName;
        $todays_birthdays = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%'.$tdy.'%')->get();                                                

        //Work anniversary
        $tdy_work_anniversary = DB::table('customusers')->select('*')->where('doj', 'LIKE', '%'.$tdy.'%')->get();                                                
        
        //Upcoming holidays
        $upcoming_holidays = DB::table('holidays')->select('*')->where('date', '>=', $date)->limit(2)->get();                                                
                
        //Upcoming events
        $logined_empid = Auth::user()->empID;
        $upcoming_events = DB::table('event_attendees')
                     ->distinct()         
                     ->select('events.*')         
                     ->join('events', 'event_attendees.event_id', '=', 'events.event_unique_code')
                     ->where('events.start_date_time', '>=', $date)
                     ->where('event_attendees.candidate_name', $logined_empid)
                     ->limit(2)
                     ->get();

        $data = [
            "todays_birthdays" => $todays_birthdays,
            "tdy_work_anniversary" => $tdy_work_anniversary,
            "upcoming_holidays" => $upcoming_holidays, 
            "upcoming_events" => $upcoming_events,
        ];

        return view('ItInfra.dashboard')->with($data);
      }

    public function EmailIdCreation()
    {
        return view('ItInfra.EmailIdCreation');
    }


}
