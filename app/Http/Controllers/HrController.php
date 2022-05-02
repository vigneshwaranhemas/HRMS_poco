<?php

namespace App\Http\Controllers;
use App\Repositories\IHrPreonboardingrepositories;
use App\Repositories\IPreOnboardingrepositories;
use App\Repositories\IAdminRepository;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Image;
use Response;

class HrController extends Controller
{
    public $preon;

    public function __construct(IHrPreonboardingrepositories $hpreon,IPreOnboardingrepositories $preon,IAdminRepository $admrpy)
    {
        $this->hpreon = $hpreon;
        $this->preon = $preon;
        $this->admrpy = $admrpy;
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
         $sess_info=Session::get("session_info");
         $id=array('pre_onboarding_status'=>$sess_info["pre_onboarding"],'created_by'=>$sess_info["empID"]);
        //  echo json_encode($sess_info);
         $user_info=$this->hpreon->get_candidate_info($id);
         $data['user_info']=$user_info;
         return view('HRSS.preOnboarding')->with('info',$data);
    }
    public function DayZero()
    {
        $sess_info=Session::get("session_info");
        $date=date('Y-m-d', strtotime("+1 day"));
        $data=array("or_doj"=>$date,'created_by'=>$sess_info["empID"]);
        $candidate_info=$this->hpreon->DayWiseCandidateInfo($data);
        return view('HRSS.Day_zero')->with('candidate_info',$candidate_info);
    }
    public function hrssOnBoarding()
    {
        $sess_info=Session::get("session_info");
        $date=date('Y-m-d');
        $data=array("or_doj"=>$date,'created_by'=>$sess_info["empID"]);
        $candidate_info=$this->hpreon->DayWiseCandidateInfo($data);
        return view('HRSS.hrssOnBoarding')->with('candidate_info',$candidate_info);
    }
    public function SeatingArrangement()
    {
        $status=0;
        $seating_info['pending']=$this->admrpy->get_seating_requested($status);
        $status=1;
        $seating_info['completed']=$this->admrpy->get_seating_requested($status);
        return view('HRSS.Seating')->with('seating_info',$seating_info);
    }

    public function EmailIdCreation()
    {
        // $sess_info=Session::get("session_info");
        // $date=date('Y-m-d');
        // $data=array("or_doj"=>$date,'created_by'=>$sess_info["empID"]);
        // $candidate_info=$this->hpreon->EmailIdCreation($data);
        // echo json_encode($candidate_info);
        return view('HRSS.EmailIdCreation');

    }
    public function Candidate_Email_Creation()
    {
        $sess_info=Session::get("session_info");
        $date=date('Y-m-d');
        $data=array("doj"=>$date,'created_by'=>$sess_info["empID"]);
        $candidate_info=$this->hpreon->EmailIdCreation($data);
    }
    public function Candidate()
    {
        return view('HRSS.candidate');
    }
    public function userdocuments(Request $request)
    {
        $id=$request->id;
        $user_documents=$this->hpreon->getUserDocuments($id);
        return view('HRSS.userdocuments')->with('user_documents',$user_documents);
    }
    public function Show_preOnBoarding(Request $request)
    {
       $user_id=$request->id;
       $status=1;
       $onboarding_info=$this->hpreon->getonboardinginfo($user_id,$status);
       echo json_encode($onboarding_info);
    }
    public function EmailAndSeatingRequest(Request $request)
    {
         $data=array('cdID'=>$request->old_empID,
                     'empId'=>$request->empID,
                     'IdCard_status'=>'0',
                     'Seating_Request'=>'0',
                     'status'=>'0');
         $check_emp_info=$this->hpreon->Verify_emp_info($data);
         if($check_emp_info['seating']){
            $final_response=array('success'=>'0','message'=>'EmployeeId Aldready Created for this Candidate');
            echo json_encode($final_response);
         }
         else{
            if($check_emp_info['candidate']->sup_emp_code==""){
                $final_response=array('success'=>'0','message'=>'Kindly Assign Supervisor For This Candidate');
                echo json_encode($final_response);
            }
            else{
                    $store_result=$this->hpreon->Insert_Candidate_empId($data);
                    $Mail['candidate_name']=$store_result["message"]["induction_info"]->username;
                    $Mail['username']=$request->empID;
                    $Mail['password']="Welcome@123";
                    $Mail['candidate_department']=$store_result["message"]["induction_info"]->department;
                    $Mail['candidate_doj']=$store_result["message"]["induction_info"]->doj;
                    $Mail['cc']=$store_result["message"]["email_info"]->cc;
                    $Mail['Admin_cc']=$store_result['message']['admin_email_info']->cc;
                    $Mail['hr_subject']=$store_result['message']['email_info']->subject;
                    $Mail['Admin_Subject']=$store_result['message']['admin_email_info']->subject;
                    $Mail['hr_to_mail']=$store_result['message']['email_info']->to;
                    $Mail['admin_to_mail']=$store_result['message']['admin_email_info']->to;
                    $Mail['supervisor_name']=$store_result['message']['location']->sup_name;
                    $Mail['worklocation']=$store_result['message']['location']->worklocation;
                    // $Mail['supervisor_email']=$store_result['message']['supervisor_info']->email;
                    $Mail['supervisor_email']="vigneshwaran@hemas.in";
                    $str_arr = preg_split ("/\,/", $Mail['cc']);
                    $admin_str_arr=preg_split ("/\,/", $Mail['Admin_cc']);

                        // echo json_encode($Mail);
                    // dd(env('MAIL_USERNAME'));
                    // Mail::send('emails.InductionMail', $Mail, function ($message) use ($Mail,$str_arr) {
                    // $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');
                    // foreach($str_arr as $string)
                    // {
                    //     $message->cc($string);
                    // }
                    // $message->to($Mail['hr_to_mail'])->subject($Mail['hr_subject']);
                    // });

                     Mail::send('emails.InductionMail', $Mail, function ($message) use ($Mail,$str_arr) {
                    $message->from("rfh@hemas.in", 'HEPL - HR Team');
                    foreach($str_arr as $string)
                    {
                        $message->cc($string);
                    }
                    $message->to($Mail['hr_to_mail'])->subject($Mail['hr_subject']);
                    });
                    // //  if($store_result['message']['location']->worklocation=='Onsite'){
                        Mail::send('emails.AdminMail', $Mail, function ($message) use ($Mail,$admin_str_arr) {
                        $message->from("rfh@hemas.in", 'HEPL - HR Team');
//
//                     //  if($store_result['message']['location']->worklocation=='Onsite'){
//                         Mail::send('emails.AdminMail', $Mail, function ($message) use ($Mail,$admin_str_arr) {
//                         $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');
//
                        foreach($admin_str_arr as $string)
                        {
                            $message->cc($string);
                        }
                        $message->cc($Mail['supervisor_email']);
                        $message->to($Mail['admin_to_mail'])->subject($Mail['Admin_Subject']);
                        });
                    //  }
                        $final_response=array('success'=>'1','message'=>'EmployeeId  Created Successfully');
                        echo json_encode($final_response);
            }



         }






    }


    //It Infra Email Trigger function

     public function Candidate_Email_Status_update(Request $request)
     {

            $ItInfra_email_info=$this->hpreon->get_itinfra_email_info();

            foreach($request->info as $data){
                 $candidate_info=$this->hpreon->candidate_info_for_EmailCreation($data);

//
// --------------------------------------------------------------------------------------------------
             //vignesh comments for original cc and email creditionals
//
                //  $Mail['CC']=$ItInfra_email_info->cc;
                //  $Mail['to']=$ItInfra_email_info->to;
                //  $Mail['supervisor_mail']=$candidate_info['supervisor_info']->email;
                //  $Mail['reviewer_mail']=$candidate_info['reviewer_info']->email;
//
// ---------------------------------------------------------------------------------------------------
//
         //vignesh comments for static cc and email creditionals for testing purpose
                $Mail['CC']="vigneshsampletester@gmail.com";
                $Mail['to']="vigneshb@hemas.in";
                $Mail['supervisor_mail']="vigneshb@hemas.in";
                $Mail['reviewer_mail']="vigneshb@hemas.in";
                $Mail['subject']=$ItInfra_email_info->subject;
                $Mail['candidate_name']=$candidate_info['info']->username;
                $Mail['supervisor_name']=$candidate_info['supervisor_info']->username;
                $Mail['doj']=$candidate_info['info']->doj;
                $str_arr=preg_split ("/\,/", $Mail['CC']);

// --------------------------------------------------------------------------------------------------------
                Mail::send('emails.ItInfraMail', $Mail, function ($message) use ($Mail,$str_arr) {
                $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');
                foreach($str_arr as $string)
                {
                    $message->cc($string);
                }
                $message->cc($Mail['supervisor_mail']);
                $message->cc($Mail['reviewer_mail']);
                $message->to($Mail['to'])->subject($Mail['subject']);
                });

            }
            $final_response=array('success'=>1,'message'=>"Suggested Email Informations Send to The ItINfra Team Successfully");
            echo json_encode($final_response);
     }

     public function view_welcome_aboard_hr()
    {
        return view('HRSS.view_welcome_aboard_hr');
    }

    public function welcome_aboard_generate_image(Request $req)
    {
        $data = $req->summernote_get;
        // echo 'sd<pre>';print_r($data);die();

        // $img = Image::make(public_path('assets/images/image_generator/birds.jpg'));
        $img = Image::canvas(800, 600,'#ffffff');

        // write text
        // $img->text($data, 100, 80);
       $img->text($data , 50, 80, function($font) {
            $font->size(80);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
            $font->angle(45);
        });

        $img->save(public_path('assets/images/image_generator/image.jpg'));

        $response = 'success';
        return response()->json( ['response' => $response] );
        echo json_encode($data);
    }

  //vignesh code for user document status update
     public function UpdateDocumentStatus(Request $request)
     {
          $id=$request->id;
          $status=array('doc_status'=>$request->status);
          $status_update=$this->hpreon->update_candidate_doc_status($id,$status);
          if($status_update){
               $response=array('success'=>1,'message'=>"Status Updated Successfully");
          }
          else{
            $response=array('success'=>2,'message'=>"Problem In Updating Status");
          }
          echo json_encode($response);
     }

    //vignesh code for user status update

    public function CandidateOnboardStatusUpdate(Request $request)
    {
        $id=$request->id;
        $status=array('pre_onboarding'=>'0');
        $status_update=$this->hpreon->update_candidate_doc_status($id,$status);
        if($status_update){
             $response=array('success'=>1,'message'=>"Status Updated Successfully");
        }
        else{
          $response=array('success'=>2,'message'=>"Problem In Updating Status");
        }
        echo json_encode($response);
    }





}
