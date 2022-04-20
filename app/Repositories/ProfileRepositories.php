<?php
namespace App\Repositories;
use App\band;
use App\blood_group;
use App\candidate_education_information;
use App\client;
use App\department;
use App\designation;
use App\division;
use App\function_master;
use App\grade;
use App\location;
use App\roll;
use App\state;
use App\zone;
use Illuminate\Support\Facades\DB;
use App\menu;
use App\sub_menu;
use App\role_permission;
use App\Role;
use App\welcome_aboard;

class ProfileRepositories implements IProfileRepositories
{
	public function get_account_info( $input_details ){

        $bandtbl = DB::table('candidate_account_information')
        ->select('*')
        ->where('cdID', '=', $input_details['cdID'])
        ->get();

        return $bandtbl;
    }
    public function update_account_info( $input_details ){

        $update_roletbl = DB::table('candidate_account_information')->where( 'cdID', '=', $input_details['cdID'] );
        $update_roletbl->update( [
            'emp_id' => $input_details['emp_id'],
            'cdID' => $input_details['cdID'],
            'acc_name' => $input_details['acc_name'],
            'acc_number' => $input_details['acc_number'],
            'bank_name' => $input_details['bank_name'],
            'ifsc_code' => $input_details['ifsc_code'],
            'acc_mobile' => $input_details['acc_mobile'],
            'branch_name' => $input_details['branch_name'],
        ] );
    }

    public function insert_education_info( $input_details ){

        $response = candidate_education_information::insert($input_details);
        // echo "<pre>";print_r($response);die;
      return $response;
    }

    /*education_info*/
    public function education_info( $input_details ){

        $bandtbl = DB::table('candidate_education_information')
        ->select('*')
        ->where('cdID', '=', $input_details['cdID'])
        ->get();

        return $bandtbl;
    }
    /*experience_info*/
    public function experience_info( $input_details ){

        $bandtbl = DB::table('candidate_experience_details')
        ->select('*')
        ->where('cdID', '=', $input_details['cdID'])
        ->get();

        return $bandtbl;
    }

}