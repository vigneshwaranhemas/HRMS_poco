<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\IHrPreonboardingrepositories;
use App\Repositories\IPreOnboardingrepositories;
use Mail;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{

    public function __construct(IHrPreonboardingrepositories $hpreon,IPreOnboardingrepositories $preon){
        $this->hpreon=$hpreon;
        $this->preon = $preon;
    }

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
                'cdID'=>auth()->user()->cdID,
                'username' => auth()->user()->username,
                'username' => auth()->user()->username,
                'role_type' => auth()->user()->role_type,
                'active' => auth()->user()->active,
            ];

            Session::put("session_info",$info);

            if (auth()->user()->role_type == 'Admin') {
                return response()->json( ['url'=>url( 'admin_dashboard' ), 'logstatus' => 'success'] );
            }else if (auth()->user()->role_type == 'can') {
                return response()->json( ['url'=>url( 'candidate_dashboard' ), 'logstatus' => 'success'] );
            }else if (auth()->user()->role_type == 'HR') {
                return response()->json( ['url'=>url( 'hr_dashboard' ), 'logstatus' => 'success'] );
            }else if (auth()->user()->role_type == 'Buddy') {
                return response()->json( ['url'=>url( 'buddy_dashboard' ), 'logstatus' => 'success'] );
            }else if (auth()->user()->role_type == 'Itinfra') {
                return response()->json( ['url'=>url('ItInfra_Dashboard' ), 'logstatus' => 'success'] );
            }else if (auth()->user()->role_type == 'Site Admin') {
                return response()->json( ['url'=>url('site_admin_dashboard' ), 'logstatus' => 'success'] );
            }
        }else{
            return response()->json( ['url'=>url( '../' ), 'logstatus' => 'failed'] );
        }
    }


    public function UserEmailSend()
    {
         $candidate_info=$this->hpreon->get_onboarding_candidate_info();
         $i=0;

        //   echo json_encode($candidate_info);



         foreach($candidate_info as $candidate)
         {
                $data['candidate_name']=$candidate->candidate_name;
                $data['candidate_mail']=$candidate->candidate_email;
                $subject="Inducation Agenda Mail";
                Mail::send('emails.InductionAgendaMail', $data, function ($message) use ($data,$subject,$i) {
                    $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');

                    $message->to($data['candidate_mail'])->subject($subject);
                    });
                    // die();
                $update_data[]=array("empID"=>$candidate->cdID,"Induction_mail"=>1);
                $i++;
            }
        //   $response=$this->hpreon->Update_mail_status($update_data);
        //   echo $response;
        //   if($response){
            //    echo '<script>toastr.success("Email Send Successfully")</script>';
        //   }
        //   else{
            // echo '<script>toastr.success("Something Went Wrong Please Try Again Later!....")</script>';

        //   }



    }




}
