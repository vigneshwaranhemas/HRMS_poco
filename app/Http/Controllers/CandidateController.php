<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function candidate_dashboard()
    {
        return view('candidate.dashboard');
    }

    public function candidate_goals()
    {
        return view('candidate.goals');
    }  
    public function candidate_add_goal_setting()
    {
        return view('candidate.add_goal_setting');
    }    
    public function candidate_goal_setting()
    {
        return view('candidate.goal_setting');
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
