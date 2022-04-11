<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'username' => auth()->user()->username,
                'username' => auth()->user()->username,
                'role_type' => auth()->user()->role_type,
                'pre_onboarding' => auth()->user()->pre_onboarding,
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
            }
        }else{
            return response()->json( ['url'=>url( '../' ), 'logstatus' => 'failed'] );
        }
    }
}
