<?php
namespace App\Repositories;
use App\band;
use App\blood_group;
use App\candidate_education_information;
use App\candidate_education_details;
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
            'con_acc_number' => $input_details['con_acc_number'],
            'acc_number' => $input_details['acc_number'],
            'bank_name' => $input_details['bank_name'],
            'ifsc_code' => $input_details['ifsc_code'],
            'acc_mobile' => $input_details['acc_mobile'],
            'branch_name' => $input_details['branch_name'],
        ] );
    }
    public function update_banner_image( $input_details ){

        $update_roletbl = DB::table('candidate_banner_image')->where( 'cdID', '=', $input_details['cdID'] );
        $update_roletbl->update( [
            'emp_id' => $input_details['emp_id'],
            'cdID' => $input_details['cdID'],
            'banner_image' => $input_details['banner_image'],
            
        ] );
    }
    public function get_banner_view( $input_details ){

        $bandtbl = DB::table('candidate_banner_image')
        ->select('*')
        ->where('cdID', '=', $input_details['cdID'])
        // ->join('customusers as cus', 'cus.cdID', '=', 'img.cdID')
        ->first();
        // echo "<pre>";print_r($bandtbl);die;
        return $bandtbl;
    }

    public function insert_education_info( $input_details ){

        $response = candidate_education_details::insert($input_details);
        // echo "<pre>";print_r($response);die;
      return $response;
    }

    /*education_info*/
    public function education_info( $input_details ){

        $bandtbl = DB::table('candidate_education_details')
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
    /*Contact info*/
    public function Contact_info( $input_details ){

        $bandtbl = DB::table('candidate_contact_information')
        ->select('*')
        ->where('cdID', '=', $input_details['cdID'])
        ->get();

        return $bandtbl;
    }
    public function update_contact( $input_details ){

        $update_roletbl = DB::table('candidate_contact_information')->where( 'cdID', '=', $input_details['cdID'] );
        $update_roletbl->update( [
            'emp_id' => $input_details['emp_id'],
            'cdID' => $input_details['cdID'],
            'phone_number'=>$input_details['phone_number'],
            's_number'=>$input_details['s_number'],
            'p_addres'=>$input_details['p_addres'],
            'p_town'=>$input_details['p_town'],
            'p_State'=>$input_details['p_State'],
            'p_district'=>$input_details['p_district'],
            'c_addres'=>$input_details['c_addres'],
            'c_town'=>$input_details['c_town'],
            'c_State'=>$input_details['c_State'],
            'c_district'=>$input_details['c_district'],
            'p_email'=>$input_details['p_email'],
            // 'State'=>$input_details['State'],
        ]);
    }
    public function family_info( $input_details ){

        $bandtbl = DB::table('candidate_family_information')
        ->select('*')
        ->where('cdID', '=', $input_details['cdID'])
        ->get();

        return $bandtbl;
    }
    public function state_listing(){
        // DB::enableQueryLog();
        $bandtbl = DB::table('towns_details')
        ->select('id','state_name')
        ->groupBy('state_name')
        ->get();
        // dd(DB::getQueryLog());

        return $bandtbl;
    }
    public function get_district_listing($input_details){
        $bandtbl = DB::table('towns_details')
        ->select('id','district_name','state_name')
        ->where('state_name', '=' ,$input_details['state_name'])
        ->groupBy('district_name')
        ->get();

        return $bandtbl;
    }
    public function get_town_name_listing($input_details){
        // DB::enableQueryLog();
        $bandtbl = DB::table('towns_details')
        ->select('id','district_name','town_name','state_name')
        ->where('district_name', '=' ,$input_details['district_name'])
        // ->groupBy('district_name')
        ->get();
        // dd(DB::getQueryLog());

        return $bandtbl;
    }

}