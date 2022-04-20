<?php

namespace App\Http\Controllers;
use App\Repositories\IHrPreonboardingrepositories;
use App\Repositories\IPreOnboardingrepositories;
use App\Repositories\IAdminRepository;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use Mail;

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

        return view('HRSS.dashboard');
    }

    public function preOnboarding()
    {
         $sess_info=Session::get("session_info");
         $id=array('pre_onboarding_status'=>$sess_info["pre_onboarding"],'created_by'=>$sess_info["empID"]);
         $user_info=$this->hpreon->get_candidate_info($id);
         $data['user_info']=$user_info;

        //  echo json_encode($data);
         return view('HRSS.preOnboarding')->with('info',$data);
        // return view('HRSS.preOnboarding');

    }
    public function DayZero()
    {
        $sess_info=Session::get("session_info");
        $date=date('Y-m-d', strtotime("+1 day"));
        $data=array("or_doj"=>$date,'created_by'=>$sess_info["empID"]);
        $candidate_info=$this->hpreon->DayWiseCandidateInfo($data);
        // echo json_encode($candidate_info);
        return view('HRSS.Day_zero')->with('candidate_info',$candidate_info);
        // return view('HRSS.Day_zero');

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
        $data=array("or_doj"=>$date,'created_by'=>$sess_info["empID"]);
        $candidate_info=$this->hpreon->EmailIdCreation($data);
        echo json_encode($candidate_info);
    }
    public function Candidate()
    {
        return view('HRSS.candidate');
    }
    public function userdocuments()
    {
        return view('HRSS.userdocuments');
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
                                $Mail['candidate_name']=$store_result["message"]["induction_info"]->candidate_name;
                                $Mail['username']=$request->empID;
                                $Mail['password']="Welcome@123";
                                $Mail['candidate_department']=$store_result["message"]["induction_info"]->or_department;
                                $Mail['candidate_doj']=$store_result["message"]["induction_info"]->or_doj;
                                $Mail['cc']=$store_result["message"]["email_info"]->cc;
                                $Mail['Admin_cc']=$store_result['message']['admin_email_info']->cc;
                                $Mail['hr_subject']=$store_result['message']['email_info']->subject;
                                $Mail['Admin_Subject']=$store_result['message']['admin_email_info']->subject;
                                $Mail['hr_to_mail']=$store_result['message']['email_info']->to;
                                $Mail['admin_to_mail']=$store_result['message']['admin_email_info']->to;
                                $Mail['supervisor_name']=$store_result['message']['location']->sup_name;
                                $Mail['worklocation']=$store_result['message']['location']->worklocation;
                                $str_arr = preg_split ("/\,/", $Mail['cc']);
                                $admin_str_arr=preg_split ("/\,/", $Mail['Admin_cc']);
                                Mail::send('emails.InductionMail', $Mail, function ($message) use ($Mail,$str_arr) {
                                $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');
                                foreach($str_arr as $string)
                                {
                                 $message->cc($string);
                                }
                                $message->to($Mail['hr_to_mail'])->subject($Mail['hr_subject']);
                                });
                                //  if($store_result['message']['location']->worklocation=='Onsite'){
                                    Mail::send('emails.AdminMail', $Mail, function ($message) use ($Mail,$admin_str_arr) {
                                    $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');
                                    foreach($admin_str_arr as $string)
                                    {
                                     $message->cc($string);
                                    }
                                    $message->to($Mail['admin_to_mail'])->subject($Mail['Admin_Subject']);
                                    });
                                //  }
                                 $final_response=array('success'=>'1','message'=>'EmployeeId  Created Successfully');
                                 echo json_encode($final_response);
            }



         }


        //  $store_result=$this->hpreon->Insert_Candidate_empId($data);
        //  if($store_result["success"]=='0')
        //  {
        //       echo json_encode($store_result["message"]);
        //  }
        //  else{
        //         $Mail['candidate_name']=$store_result["message"]["induction_info"]->candidate_name;
        //         $Mail['username']=$request->empID;
        //         $Mail['password']="Welcome@123";
        //         $Mail['candidate_department']=$store_result["message"]["induction_info"]->or_department;
        //         $Mail['candidate_doj']=$store_result["message"]["induction_info"]->or_doj;
        //         $Mail['cc']=$store_result["message"]["email_info"]->cc;
        //         $Mail['Admin_cc']=$store_result['message']['admin_email_info']->cc;
        //         $Mail['hr_subject']=$store_result['message']['email_info']->subject;
        //         $Mail['Admin_Subject']=$store_result['message']['admin_email_info']->subject;
        //         $Mail['hr_to_mail']=$store_result['message']['email_info']->to;
        //         $Mail['admin_to_mail']=$store_result['message']['admin_email_info']->to;
        //         $str_arr = preg_split ("/\,/", $Mail['cc']);
        //         $admin_str_arr=preg_split ("/\,/", $Mail['Admin_cc']);
        //         Mail::send('emails.InductionMail', $Mail, function ($message) use ($Mail,$str_arr) {
        //         $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');
        //         foreach($str_arr as $string)
        //         {
        //          $message->cc($string);
        //         }
        //         $message->to($Mail['hr_to_mail'])->subject($Mail['hr_subject']);
        //         });
        //          if($store_result['message']['location']->worklocation=='Onsite'){
        //             Mail::send('emails.AdminMail', $Mail, function ($message) use ($Mail,$admin_str_arr) {
        //             $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');
        //             foreach($admin_str_arr as $string)
        //             {
        //              $message->cc($string);
        //             }
        //             $message->to($Mail['admin_to_mail'])->subject($Mail['Admin_Subject']);
        //             });
        //          }

        //  }



    }


    //It Infra Email Trigger function

     public function Candidate_Email_Status_update(Request $request)
     {

            $ItInfra_email_info=$this->hpreon->get_itinfra_email_info();

            foreach($request->info as $data){
                 $candidate_info=$this->hpreon->candidate_info_for_EmailCreation($data);
                //  $Mail['CC']=$ItInfra_email_info->cc;
                //  $Mail['to']=$ItInfra_email_info->to;
                //  $Mail['supervisor_mail']=$candidate_info['supervisor_info']->email;
                //  $Mail['reviewer_mail']=$candidate_info['reviewer_info']->email;
                $Mail['CC']="vigneshsampletester@gmail.com";
                $Mail['to']="vigneshb@hemas.in";
                $Mail['supervisor_mail']="vigneshb@hemas.in";
                $Mail['reviewer_mail']="vigneshb@hemas.in";
                $Mail['subject']=$ItInfra_email_info->subject;
                $Mail['candidate_name']=$candidate_info['info']->username;
                $Mail['supervisor_name']=$candidate_info['supervisor_info']->name;
                $Mail['doj']=$candidate_info['info']->doj;
                $str_arr=preg_split ("/\,/", $Mail['CC']);
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

            echo json_encode("success");



     }




}
