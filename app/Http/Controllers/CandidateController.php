<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }
    public function candidate_dashboard()
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

        // dd($upcoming_events);
                     
        // $upcoming_events = DB::table('events')->select('*')->where('start_date_time', '>=', $date)->limit(2)->get();                                                
        
        $data = [
            "todays_birthdays" => $todays_birthdays,
            "tdy_work_anniversary" => $tdy_work_anniversary,
            "upcoming_holidays" => $upcoming_holidays,
            "upcoming_events" => $upcoming_events,
        ];

        return view('candidate.dashboard')->with($data);
    }
    public function preOnboarding()
    {
        //    $sess_info=Session::get("session_info");
        //    $empId=$sess_info["empID"];
        //    $data=array('emp_id'=>$empId);
        //    $table="candidate_preonboarding";
        //    $table1="candidatepreonboardingfields";
        //    $fields=$this->preon->getonBoardingFields($table1);
        //    $user_info=$this->preon->Check_onBoard($table,$data);
        // //    if($user_info)
        // if($user_info)
        // {
        //     $data['user_info']=$user_info;

        // }
        // else{
        //     $data['user_info']="";
        // }

        //    $data['fields']=$fields;

        //   return view('candidate.preOnboarding')->with('userdata',$data);
        return view('candidate.preOnboarding');
    }

    public function buddy()
    {
        // $sess_info=Session::get("session_info");
        // $table1="candidate_details";
        // $cid=array("cdID"=>$sess_info["empID"]);
        // $id=array("empId"=>$sess_info["empID"]);
        // $table="buddyfeedbackfields";
        // $fields=$this->preon->getonBoardingFields($table);
        // $feedback_info=$this->preon->get_buddy_info($id);
        // $user_info=$this->preon->Check_onBoard($table1,$cid);
        // $data['fields']=$fields;
        // $data['feedback_info']=$feedback_info;
        // $data['user_info']=$user_info;


        
        // return view('candidate.buddy_feedback')->with('buddy_fields',$data);
        return view('candidate.buddy_feedback');
    }
    public function profile(){
        return view('candidate.profile');
        }

}
