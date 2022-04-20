<?php

namespace App\Http\Controllers;
use App\Repositories\IPreOnboardingrepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Session;

class CandidateController extends Controller
{
    public $preon;
    public function __construct(IPreOnboardingrepositories $preon)
    {
            $this->preon = $preon;
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

    public function CandidateInduction()
    {
        return view('candidate.Candidate_Inducation');
    }
    public function Candidate_Assigned_Buddy()
    {
        $sess_info=Session::get("session_info");
        $data=array('cdID'=>$sess_info['cdID']);
        $buddy_info=$this->preon->fetch_buddy_info($data);
        // echo json_encode($buddy_info->);
        return view('candidate.Buddy_info')->with('info',$buddy_info);
    }


    public function preOnboarding()
    {
           $sess_info=Session::get("session_info");
           $empId=$sess_info["empID"];
           $data=array('emp_id'=>$empId);
           $table="candidate_preonboarding";
           $table1="candidatepreonboardingfields";
           $fields=$this->preon->getonBoardingFields($table1);
           $user_info=$this->preon->Check_onBoard($table,$data);
            if($user_info)
            {
                $data['user_info']=$user_info;

            }
            else{
                $data['user_info']="";
            }
           $data['fields']=$fields;
         return view('candidate.preOnboarding')->with('userdata',$data);
    }

    public function buddy()
    {

        $sess_info=Session::get("session_info");
        $table1="candidate_details";
        $cid=array("cdID"=>$sess_info["empID"]);
        $id=array("empId"=>$sess_info["empID"]);
        $table="buddyfeedbackfields";
        $fields=$this->preon->getonBoardingFields($table);
        $feedback_info=$this->preon->get_buddy_info($id);
        $user_info=$this->preon->Check_onBoard($table1,$cid);
        $data['fields']=$fields;
        $data['feedback_info']=$feedback_info;
        $data['user_info']=$user_info;
        return view('candidate.buddy_feedback')->with('buddy_fields',$data);
    }




    public function profile(){
        return view('candidate.profile');
        }




// pre onBoarding Insert
public function insertPreOnboarding(Request $request)
{
       $sess_info=Session::get("session_info");
       $empId=$sess_info["empID"];
       $data=array('emp_id'=>$empId);
       $table="candidate_preonboarding";
       $table1='candidate_details';
       $data1=array('cdID'=>$sess_info['empID']);
       $table1="candidate_details";
       $candidate_info=$this->preon->get_canidate_info($table1,$data1);
       $usercheck=$this->preon->Check_onBoard($table,$data);
       $recruiter_id=$candidate_info->created_by;
       if(count($usercheck) > 0)
       {
        foreach($_POST['onboard'] as $onboard)
        {
                  if($onboard['date']=="")
                  {
                       $date=NULL;
                  }
                  else{
                      $date=$onboard['date'];
                  }

            $main_data[]=array(
                               'type'=>$onboard['verified'],
                                'date'=>$date);
        }
        // $test="1";
            $response=$this->preon->update_onboard($main_data,$empId,$usercheck);
       }
       else{
        foreach($_POST['onboard'] as $onboard)
        {
                  if($onboard['date']=="")
                  {
                       $date=NULL;
                  }
                  else{
                      $date=$onboard['date'];
                  }

            $main_data[]=array('preonboarding_process'=>$onboard['Process'],
                               'type'=>$onboard['verified'],
                                'date'=>$date,
                                'emp_id'=>$empId,
                                'recruiter_id'=>$recruiter_id);
        }
        $test="2";
             $response=$this->preon->insert_onboard($main_data);
       }


       if($response)
       {
            $result=array('type'=>1,"message"=>"Data Updated Successfully");
       }
       else{
        $result=array('type'=>2,"message"=>"Problem in Updating Data");

       }

       echo json_encode($result);
}


public function InsertBuddyFeedback(Request $request)
{
      $first_result=array();
      $final_result=[];
      $data=$request->ar;
      $data2=$request->buddy_data;
      $i=0;
      foreach($data as $vendor)
       {
           $first=$vendor["testing_data"];
                 $j=0;
                 foreach($first as $second){
                       $first_result["comments".$j.""]=$second["comment"];
                       $first_result["empId"]=$second["empID"];
                       $first_result["fieldid"]=$second["fieldid"];
                        if($j==2){
                               if($first_result["comments0"]=="" && $first_result["comments1"]=="" && $first_result["comments2"]=="")
                               {
                                   $final_response=array("success"=>0,"message"=>"Please give Any of the Comments");
                                   echo json_encode($final_response);
                                   return false;
                               }
                               else{
                                   $final_result[]=$first_result;
                                   $first_result=[];
                               }
                        }
                       $j++;
                 }
              }
               foreach($data2 as $data1){
                   $result[]=array("empId"=>$data1["empId"],
                               "fieldid"=>$data1["fieldid"],
                               "response"=>$data1["response"],
                               "comments0"=>$data1["comments0"],
                               "comments1"=>$data1["comments1"],
                               "comments2"=>$data1["comments2"],
                               "remarks"=>$data1["remarks"]);
             }
       $response=$this->preon->insert_buddy_feedback($result,$final_result);
       if($response){
            $final_response=array('status'=>1,"message"=>"Data Added Successfully");
       }
       else{
            $final_response=array('status'=>0,"message"=>"Problem in Adding Data");
       }

       echo json_encode($final_response);


}










}
