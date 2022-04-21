<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class HrController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
        // $this->middleware('is_hr');
    }
    public function hr_dashboard()
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

        return view('HRSS.dashboard')->with($data);

    }    

    public function preOnboarding()
    {
        //  $sess_info=Session::get("session_info");
        //  $id=array('pre_onboarding_status'=>$sess_info["pre_onboarding"],'created_by'=>$sess_info["empID"]);
        //  $user_info=$this->hpreon->get_candidate_info($id);
        //  $data['user_info']=$user_info;
        //  return view('HRSS.preOnboarding')->with('info',$data);
        return view('HRSS.preOnboarding');

    }
    public function DayZero()
    {
        // $sess_info=Session::get("session_info");
        // $date=date('Y-m-d', strtotime("+1 day"));
        // $data=array("or_doj"=>$date,'created_by'=>$sess_info["empID"]);
        // $candidate_info=$this->hpreon->DayWiseCandidateInfo($data);
        // return view('HRSS.Day_zero')->with('candidate_info',$candidate_info);
        return view('HRSS.Day_zero');

    }
    public function hrssOnBoarding()
    {
        // $sess_info=Session::get("session_info");
        // $date=date('Y-m-d');
        // $data=array("or_doj"=>$date,'created_by'=>$sess_info["empID"]);
        // $candidate_info=$this->hpreon->DayWiseCandidateInfo($data);
        // return view('HRSS.Day_one')->with('candidate_info',$candidate_info);
        return view('HRSS.hrssOnBoarding');

    }
    public function SeatingArrangement()
    {
         return view('HRSS.Seating');
    }

    public function EmailIdCreation()
    {
        return view('HRSS.EmailIdCreation');
    }
    public function Candidate()
    {
        return view('HRSS.candidate');
    }
    public function userdocuments()
    {
        return view('HRSS.userdocuments');
    }

}
