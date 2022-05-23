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
use Response;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use File;

class HrController extends Controller
{
    public $preon;

    public function __construct(IHrPreonboardingrepositories $hpreon,IPreOnboardingrepositories $preon,IAdminRepository $admrpy)
    {
        $this->hpreon = $hpreon;
        $this->preon = $preon;
        $this->admrpy = $admrpy;
        $this->middleware('is_admin');
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
                    $Mail['supervisor_email']=$store_result['message']['supervisor_info']->email;
                    // $Mail['supervisor_email']="vbjr317@gmail.com";
                    $str_arr = preg_split ("/\,/", $Mail['cc']);
                    $admin_str_arr=preg_split ("/\,/", $Mail['Admin_cc']);

                        // echo json_encode($Mail);
                    // dd(env('MAIL_USERNAME'));
                    Mail::send('emails.InductionMail', $Mail, function ($message) use ($Mail,$str_arr) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    foreach($str_arr as $string)
                    {
                        $message->cc($string);
                    }
                    $message->to($Mail['hr_to_mail'])->subject($Mail['hr_subject']);
                    });

                    // //  if($store_result['message']['location']->worklocation=='Onsite'){
                        Mail::send('emails.AdminMail', $Mail, function ($message) use ($Mail,$admin_str_arr) {
                        $message->from("hr@hemas.in", 'HEPL - HR Team');
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

                 $Mail['CC']=$ItInfra_email_info->cc;
                 $Mail['to']=$ItInfra_email_info->to;
                 $Mail['supervisor_mail']=$candidate_info['supervisor_info']->email;
                 $Mail['reviewer_mail']=$candidate_info['reviewer_info']->email;
//
// ---------------------------------------------------------------------------------------------------
//
         //vignesh comments for static cc and email creditionals for testing purpose
                // $Mail['CC']="vigneshsampletester@gmail.com";
                // $Mail['to']="vigneshb@hemas.in";
                // $Mail['supervisor_mail']="vigneshb@hemas.in";
                // $Mail['reviewer_mail']="vigneshb@hemas.in";
                $Mail['subject']=$ItInfra_email_info->subject;
                $Mail['candidate_name']=$candidate_info['info']->username;
                $Mail['supervisor_name']=$candidate_info['supervisor_info']->username;
                $Mail['doj']=$candidate_info['info']->doj;
                $str_arr=preg_split ("/\,/", $Mail['CC']);
                // dd($Mail);
// --------------------------------------------------------------------------------------------------------
                Mail::send('emails.ItInfraMail', $Mail, function ($message) use ($Mail,$str_arr) {
                $message->from("hr@hemas.in", 'HEPL - HR Team');
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
        $width       = 1600;
        $height      = 800;
        $center_x    = 490;
        $center_y    = 340;
        $max_len     = 120;
        $font_size   = 20;
        $font_height = 20;
        $postImagePath = null;

        $text = $req->summernote_get;
        $id = $req->id;
        $width1     = 320;
        $height1      = 400;

        $id_card_image = Image::make(public_path('ID_card_photo/'. $id .'.JPG'))->resize($width1, $height1);
        // print_r($id_card_image);die();

        $lines = explode("\n", wordwrap($text, $max_len));
        $y     = $center_y - ((count($lines) - 1) * $font_height);

        // $image   = Image::canvas($width, $height, '#ffffff');
        $image   = Image::make(public_path('/assets/images/image_generator/welcome_aboard_background_image.png'))->resize($width, $height);

        $image->insert($id_card_image, 'left', 95, 4000, 5200, 6700);

        foreach ($lines as $line)
        {
            $image->text($line, $center_x, $y, function($font) use ($font_size){
                $font->file(public_path('fonts/Roboto-Light.ttf'));
                $font->size($font_size);
                $font->color('#000000');
                $font->align('left');
                $font->valign('middle');
            });

            $y += $font_height * 2;
        }
            $welcome_aboard_image_upload_hr_result = $this->hpreon->welcome_aboard_image_upload_hr($id);

            $image->save(public_path('assets/images/image_generator/'.$id.'.jpg'));

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($text);
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
        $status_update=$this->hpreon->update_candidate_onboard_status($id,$status);
        if($status_update){
             $response=array('success'=>1,'message'=>"Status Updated Successfully");
        }
        else{
          $response=array('success'=>2,'message'=>"Problem In Updating Status");
        }
        echo json_encode($response);
    }

    public function get_welcome_aboard_details_hr(Request $req){

         $id = $req->id;
        //  echo $id;

        $get_welcome_aboard_details_result = $this->hpreon->get_welcome_aboard_details_hr($id);

        $get_welcome_aboard_details_result['get_education_my'] =  json_decode($get_welcome_aboard_details_result->education_my,TRUE);
        $get_welcome_aboard_details_result['get_education_from'] = json_decode($get_welcome_aboard_details_result->education_from,TRUE);
        $get_welcome_aboard_details_result['get_education_in'] = json_decode($get_welcome_aboard_details_result->education_in,TRUE);

        $get_welcome_aboard_details_result['get_work_experience_at'] =  json_decode($get_welcome_aboard_details_result->work_experience_at,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_as'] = json_decode($get_welcome_aboard_details_result->work_experience_as,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_years'] = json_decode($get_welcome_aboard_details_result->work_experience_years,TRUE);

    //   echo '<pre>';print_r($id);die();

        return response()->json( $get_welcome_aboard_details_result );
    }

    public function welcome_aboard_image_show(Request $req){

        $id = $req->id;

       $get_welcome_aboard_image_show_result = $this->hpreon->get_welcome_aboard_image_show_hr($id);

    //  echo '<pre>';print_r($get_welcome_aboard_image_show_result);die();

       return response()->json( $get_welcome_aboard_image_show_result );
   }


//candidate profile for hr

    public function can_hr_profile()
    {
         return view('can_hr_profile');
    }

    public function view_epf_form_hr(Request $request){
        //  $sess_info=Session::get("session_info");
         //  $cdID=$sess_info['empID'];
         $cdID=$request->input('cdID');
      $input = array(
          'cdID'=> $cdID,
      );
           $get_epf_details = $this->preon->get_candidate_epf_details($cdID);
          // print_r($get_epf_details);
          echo json_encode($get_epf_details);


       }
       public function update_epf_form_hr(Request $request){

          // $cdID="900002";
          $file_name = $request->input('emp_id') . '.epf.' . 'pdf';
          $cdID = $request->input('emp_id');
           $data = array(
              'cdID' =>$request->input('emp_id'),
              'a_pf_no'=>$request->input('a_pf_no'),
              'a_uan_no'=>$request->input('a_uan_no'),
              'ekyc_status'=>$request->input('ekyc_status'),
              'sign_status'=>$request->input('sign_status'),
              'file_name'=>$file_name,
        );
             $update_epf_form = $this->preon->update_epf_form($data);
          if( $update_epf_form){
              $response ="success";
          }
          else{
              $response ="error";
          }
         // $pdf_data =array();
         $get_epf_details = $this->preon->get_candidate_epf_details($cdID);

         $data = [
          'cdID' =>$cdID,
          'member_name'=>$get_epf_details[0]['member_name'],
          'father_name'=>$get_epf_details[0]['father_name'],
          'spouse_name'=>$get_epf_details[0]['spouse_name'],
          'dob'=>$get_epf_details[0]['dob'],
          'gender'=>$get_epf_details[0]['gender'],
          'marry_status'=>$get_epf_details[0]['marry_status'],
          'email_id'=>$get_epf_details[0]['email_id'],
          'mob'=>$get_epf_details[0]['mob'],
          'epfs_status'=>$get_epf_details[0]['epfs_status'],
          'eps_status'=>$get_epf_details[0]['eps_status'],
          'uan_number'=>$get_epf_details[0]['uan_number'],
          'prev_pf_no'=>$get_epf_details[0]['prev_pf_no'],
          'date_prev_exit'=>$get_epf_details[0]['date_prev_exit'],
          'scheme_cert_no'=>$get_epf_details[0]['scheme_cert_no'],
          'ppo'=>$get_epf_details[0]['ppo'],
          'int_work_status'=>$get_epf_details[0]['int_work_status'],
          'coun_origin'=>$get_epf_details[0]['coun_origin'],
          'passport_no'=>$get_epf_details[0]['passport_no'],
          'val_passport_from'=>$get_epf_details[0]['val_passport_from'],
          'val_passport_to'=>$get_epf_details[0]['val_passport_to'],
          'bank_account'=>$get_epf_details[0]['bank_account'],
          'aadhar_no'=>$get_epf_details[0]['aadhar_no'],
          'pan_no'=>$get_epf_details[0]['pan_no'],
          'a_pf_no'=>$get_epf_details[0]['a_pf_no'],
          'a_uan_no'=>$get_epf_details[0]['a_uan_no'],
          'ekyc_status'=>$get_epf_details[0]['ekyc_status'],
          'sign_status'=>$get_epf_details[0]['sign_status'],
         ];
      $pdf = PDF::loadView('HRSS/epf_form_pdf', $data);
      $path = public_path().'/epf_form/'.$cdID;
      File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

      $fileName = $cdID . '.epf.' . 'pdf';
      $pdf->save($path . '/' . $fileName);

      return response()->json( [
          'response' => $response,
          'redirect_url' => '../epf_form/'.$cdID.'/'.$fileName,
      ]

  );
      }
       public function view_can_epf()
       {
           return view('HRSS.view_epf_form_hr');
       }
   public function epf_details(Request $request){
      if ($request->ajax()) {

          $get_epf_list = $this->hpreon->get_epf_list_data( );


      return DataTables::of($get_epf_list)
      ->addIndexColumn()



      ->addColumn('action', function($row) {

          $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                      <div class="dropdown-menu">';
                      if($row->file_name == " "){
              $btn .='<a class="dropdown-item" href="'.route('view_can_epf',$row->cdID).'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                      </div>';
                      }
                      else{
                   $btn .='<a class="dropdown-item" href="../epf_form/'.$row->cdID.'/'.$row->file_name.'" target="_blank" class="sa-params"><i class="fa fa-eyes" aria-hidden="true"></i> View</a>
                   </div>';
                      }

          return $btn;
      })


      ->rawColumns(['action'])

      ->make(true);
      }

   }
  public function epf_list(){
      return view('HRSS/epf_details');
  }
  public function medical_list(){
      return view('HRSS/medical_details');
  }

  public function medical_details(Request $request){
      if ($request->ajax()) {

          $get_medical_list = $this->hpreon->get_medical_list_data( );


      return DataTables::of($get_medical_list)
      ->addIndexColumn()



      ->addColumn('action', function($row) {

          $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                      <div class="dropdown-menu">';
                      if($row->file_name == " "){
              $btn .='<a class="dropdown-item" href="'.route('view_can_epf',$row->cdID).'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                      </div>';
                      }
                      else{
                   $btn .='<a class="dropdown-item" href="../medical_insurance/'.$row->cdID.'/'.$row->file_name.'" target="_blank" class="sa-params"><i class="fa fa-eyes" aria-hidden="true"></i> View</a>
                   </div>';
                      }

          return $btn;
      })


      ->rawColumns(['action'])

      ->make(true);
      }

   }




}
