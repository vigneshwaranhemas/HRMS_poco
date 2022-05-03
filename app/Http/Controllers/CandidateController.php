<?php

namespace App\Http\Controllers;
use App\Repositories\IPreOnboardingrepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;
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

    public function profile(){
        return view('candidate.profile');
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
        $cdID=$sess_info['cdID'];
        $buddy_info=$this->preon->fetch_buddy_info($cdID);
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
        $candiate_buddy_data=array("empId"=>$sess_info["empID"],
                                   "cdID"=>$sess_info["cdID"]);
        $id=array("empId"=>$sess_info["empID"]);
        $table="buddyfeedbackfields";
        $fields=$this->preon->getonBoardingFields($table);
        $feedback_info=$this->preon->get_buddy_info($id);
        $user_info=$this->preon->get_candidate_and_buddy_info($candiate_buddy_data);
        $data['fields']=$fields;
        $data['feedback_info']=$feedback_info;
        $data['user_info']=$user_info;
        return view('candidate.buddy_feedback')->with('buddy_fields',$data);
    }

    public function welcome_aboard()
    {
        return view('candidate.welcome_aboard');
    }
    public function view_welcome_aboard()
    {
        return view('candidate.view_welcome_aboard');
    }

    // Welcome Aboard Process Start
    public function add_welcome_aboard_process(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'today_date' => 'required',
            'work_in' => 'required',
            'work_designation' => 'required',
            'work_years' => 'required',
            'joining_at' => 'required',
            'joining_as' => 'required',
            ]);

        // $session_val = Session::get('session_info');
        // $emp_ID = $session_val['empID'];
        // echo '<pre>';print_r($emp_ID);
        // die;

        $wa_id = 'WA'.((DB::table( 'welcome_aboards' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');

        $did_my = $req->input('did_my');
        $did_my_json = json_encode($did_my);

        $did_from = $req->input('did_from');
        $did_from_json = json_encode($did_from);

        $did_in = $req->input('did_in');
        $did_in_json = json_encode($did_in);

        $work_experience_at = $req->input('work_experience_at');
        $work_experience_at_json = json_encode($work_experience_at);

        $work_experience_as = $req->input('work_experience_as');
        $work_experience_as_json = json_encode($work_experience_as);

        $work_experience_years = $req->input('work_experience_years');
        $work_experience_years_json = json_encode($work_experience_years);

        $form_data = array(
            'wa_id' => $wa_id,
            'name' => $req->input('name'),
            'designation' => $req->input('designation'),
            'department' => $req->input('department'),
            'today_date' => $req->input('today_date'),
            'education_my' => $did_my_json,
            'education_from' => $did_from_json,
            'education_in' => $did_in_json,
            'achievements_education' => $req->input('achievements_education'),
            'work_in' => $req->input('work_in'),
            'work_designation' => $req->input('work_designation'),
            'work_years' => $req->input('work_years'),
            'work_experience_at' => $work_experience_at_json,
            'work_experience_as' => $work_experience_as_json,
            'work_experience_years' => $work_experience_years_json,
            'joining_at' => $req->input('joining_at'),
            'joining_as' => $req->input('joining_as'),
            'achievements_work' => $req->input('achievements_work'),
            'my_favorite_pastime' => $req->input('my_favorite_pastime'),
            'my_favorite_hobbies' => $req->input('my_favorite_hobbies'),
            'my_favorite_places' => $req->input('my_favorite_places'),
            'my_favorite_foods' => $req->input('my_favorite_foods'),
            'my_favorite_sports' => $req->input('my_favorite_sports'),
            'my_favorite_movies' => $req->input('my_favorite_movies'),
            'my_favorite' => $req->input('my_favorite'),
            'my_extracurricular_specialities' => $req->input('my_extracurricular_specialities'),
            'my_career_aspirations' => $req->input('my_career_aspirations'),
            'languages' => $req->input('languages'),
            'interesting_facts' => $req->input('interesting_facts'),
            'my_motto' => $req->input('my_motto'),
            'books' => $req->input('books'),
            'created_on' => $today_date,
            'created_by' => "900002"

        );
        // echo '<pre>';print_r($form_data);
        // die;
        $add_welcome_aboard_process_result = $this->preon->add_welcome_aboard_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_welcome_aboard_details(Request $req){

        $get_welcome_aboard_details_result = $this->preon->get_welcome_aboard_details();

        $get_welcome_aboard_details_result['get_education_my'] =  json_decode($get_welcome_aboard_details_result->education_my,TRUE);
        $get_welcome_aboard_details_result['get_education_from'] = json_decode($get_welcome_aboard_details_result->education_from,TRUE);
        $get_welcome_aboard_details_result['get_education_in'] = json_decode($get_welcome_aboard_details_result->education_in,TRUE);

        $get_welcome_aboard_details_result['get_work_experience_at'] =  json_decode($get_welcome_aboard_details_result->work_experience_at,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_as'] = json_decode($get_welcome_aboard_details_result->work_experience_as,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_years'] = json_decode($get_welcome_aboard_details_result->work_experience_years,TRUE);

    //   echo '<pre>';print_r($get_welcome_aboard_details_result);die();

        return response()->json( $get_welcome_aboard_details_result );
    }

    public function welcome_aboard_generate_pdf()
    {

        $get_welcome_aboard_details_result = $this->preon->get_welcome_aboard_details();

        // echo '<pre>';print_r($get_welcome_aboard_details_result->name);die();

        $get_welcome_aboard_details_result['get_education_my'] =  json_decode($get_welcome_aboard_details_result->education_my,TRUE);
        $get_welcome_aboard_details_result['get_education_from'] = json_decode($get_welcome_aboard_details_result->education_from,TRUE);
        $get_welcome_aboard_details_result['get_education_in'] = json_decode($get_welcome_aboard_details_result->education_in,TRUE);

        $get_welcome_aboard_details_result['get_work_experience_at'] =  json_decode($get_welcome_aboard_details_result->work_experience_at,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_as'] = json_decode($get_welcome_aboard_details_result->work_experience_as,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_years'] = json_decode($get_welcome_aboard_details_result->work_experience_years,TRUE);

        // $info = "";

        $info = [
            'name' => $get_welcome_aboard_details_result->name,
            'designation' => $get_welcome_aboard_details_result->designation,
            'department' => $get_welcome_aboard_details_result->department,
            'today_date' => $get_welcome_aboard_details_result->today_date,
            'get_education_my' => $get_welcome_aboard_details_result['get_education_my'],
            'get_education_from' => $get_welcome_aboard_details_result['get_education_from'],
            'get_education_in' => $get_welcome_aboard_details_result['get_education_in'],
            'achievements_education' => $get_welcome_aboard_details_result->achievements_education,
            'work_in' => $get_welcome_aboard_details_result['work_in'],
            'work_designation' => $get_welcome_aboard_details_result['work_designation'],
            'work_years' => $get_welcome_aboard_details_result['work_years'],
            'work_experience_at' => $get_welcome_aboard_details_result['get_work_experience_at'],
            'work_experience_as' => $get_welcome_aboard_details_result['get_work_experience_as'],
            'work_experience_years' => $get_welcome_aboard_details_result['get_work_experience_years'],
            'joining_at' => $get_welcome_aboard_details_result['joining_at'],
            'joining_as' => $get_welcome_aboard_details_result['joining_as'],
            'achievements_work' => $get_welcome_aboard_details_result['achievements_work'],
            'my_favorite_pastime' => $get_welcome_aboard_details_result['my_favorite_pastime'],
            'my_favorite_hobbies' => $get_welcome_aboard_details_result['my_favorite_hobbies'],
            'my_favorite_places' => $get_welcome_aboard_details_result['my_favorite_places'],
            'my_favorite_foods' => $get_welcome_aboard_details_result['my_favorite_foods'],
            'my_favorite_sports' => $get_welcome_aboard_details_result['my_favorite_sports'],
            'my_favorite_movies' => $get_welcome_aboard_details_result['my_favorite_movies'],
            'my_favorite' => $get_welcome_aboard_details_result['my_favorite'],
            'my_extracurricular_specialities' => $get_welcome_aboard_details_result['my_extracurricular_specialities'],
            'my_career_aspirations' => $get_welcome_aboard_details_result['my_career_aspirations'],
            'languages' => $get_welcome_aboard_details_result['languages'],
            'interesting_facts' => $get_welcome_aboard_details_result['interesting_facts'],
            'my_motto' => $get_welcome_aboard_details_result['my_motto'],
            'books' => $get_welcome_aboard_details_result['books'],

        ];

        // echo '<pre>';print_r($data['get_education_my']["0"]);die();

        // return view('admin.welcome_aboard_pdf')->with('info',$data);
        // $pdf = PDF::loadView('admin.welcome_aboard_pdf', $data);
        $pdf = PDF::loadView('candidate.welcome_aboard_pdf', compact('info'));

        return $pdf->download('welcome_aboard.jpeg');
    }
// pre onBoarding Insert
public function insertPreOnboarding(Request $request)
{
       $sess_info=Session::get("session_info");
       $empId=$sess_info["empID"];
       $data=array('emp_id'=>$empId);
       $table="candidate_preonboarding";
       $table1='candidate_details';
       $data1=array('cdID'=>$sess_info['cdID']);
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

public function document_center()
{
    return view('candidate.document_center');
}

public function payslip()
{
    return view('candidate.payslip');
}






}
