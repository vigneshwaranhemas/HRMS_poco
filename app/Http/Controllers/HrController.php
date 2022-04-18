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
