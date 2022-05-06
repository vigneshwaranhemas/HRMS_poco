<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login_check_process(Request $req){

        $credentials = [
            'empID' => $req['employee_id'],
            'password' => $req['login_password'],
            'active'=>'1',
        ];
        // echo "<pre>";print_r($credentials);die;
        if(auth()->attempt($credentials, true))
        {

            $info = [
                'empID' => auth()->user()->empID,
                'cdID' => auth()->user()->cdID,
                'pre_onboarding' =>auth()->user()->pre_onboarding,
                'username' => auth()->user()->username,
                'role_type' => auth()->user()->role_type,
                'role_id' => auth()->user()->role_id,
                'active' => auth()->user()->active,
                'email' => auth()->user()->email,
            ];
            // echo "<pre>";print_r($info);die;
            Session::put("session_info",$info);
             return response()->json( ['url'=>url('com_dashboard' ), 'logstatus' => 'success'] );
        }else{
            return response()->json( ['url'=>url( '../' ), 'logstatus' => 'failed'] );
        }
    }
    public function UserEmailSend()
    {
         $candidate_info=$this->hpreon->get_onboarding_candidate_info();
         $i=0;
         foreach($candidate_info as $candidate)
         {
                $data['candidate_name']=$candidate->candidate_name;
                $data['candidate_mail']=$candidate->candidate_email;
                $subject="Inducation Agenda Mail";
                Mail::send('emails.InductionAgendaMail', $data, function ($message) use ($data,$subject,$i) {
                    $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');

                    $message->to($data['candidate_mail'])->subject($subject);
                    });
                $update_data[]=array("empID"=>$candidate->cdID,"Induction_mail"=>1);
                $i++;
            }
          $response=$this->hpreon->Update_mail_status($update_data);
          if($response){
               echo '<script>toastr.success("Email Send Successfully")</script>';
          }
          else{
            echo '<script>toastr.success("Something Went Wrong Please Try Again Later!....")</script>';
          }




    }

}
