<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\CustomUser;

class CommonRepositories implements ICommonRepositories
{
	public function get_candidate_info_hr( $input_details ){
        // DB::enableQueryLog();
        $bandtbl = DB::table('customusers as cs')
        ->select('*')
        ->join('candidate_contact_information as con', 'cs.empID', '=', 'con.emp_id')
        ->join('candidate_account_information as ca', 'cs.empID', '=', 'ca.emp_id')
        ->where('cs.id', '=', $input_details['id'])
        ->get();
        // dd(DB::getQueryLog());
        // echo "<pre>";print_r($bandtbl);die;
        return $bandtbl;
    }
    public function get_candidate_exp_hr( $input_details ){

        $bandtbl = DB::table('candidate_experience_details')
        ->select('*')
        ->where('empID', '=', $input_details['empID'])
        ->get();
        return $bandtbl;
    }
    public function family_info_to_hr( $input_details ){
       // DB::enableQueryLog();
        $bandtbl = DB::table('candidate_family_information')
        ->select('*')
        ->where('emp_id', '=', $input_details['emp_id'])
        ->get();
        // dd(DB::getQueryLog());
        return $bandtbl;
    }

    public function update_hr_idcard_info( $input_details ){
        // echo "11<pre>";print_r($input_details);die;
        $update_roletbl = DB::table('customusers')->where( 'id', '=', $input_details['can_id'] );

        if ($input_details['img_path'] != "") {

           $update_roletbl->update( [
            'img_path'=>$input_details['img_path'],
            'username'=>$input_details['f_name'],
            'm_name'=>$input_details['m_name'],
            'l_name'=>$input_details['l_name'],
            'worklocation'=>$input_details['working_loc'],
            'contact_no'=>$input_details['emp_num_1'],
            'emp_num_2'=>$input_details['emp_num_2'],
            'rel_emp'=>$input_details['rel_emp'],
            'name_rel_ship'=>$input_details['name_rel_ship'],
            'emrg_con_num'=>$input_details['emrg_con_num'],
            'doj'=>$input_details['doj'],
            'blood_grp'=>$input_details['blood_grp'],
            'empID'=>$input_details['empID'],
            'email'=>$input_details['official_email'],
            'dob'=>$input_details['emp_dob'],
            'hr_action'=>'2',
            'hr_id_remark'=>'',
        ] );
        }else{
            $update_roletbl->update( [
            'username'=>$input_details['f_name'],
            'm_name'=>$input_details['m_name'],
            'l_name'=>$input_details['l_name'],
            'worklocation'=>$input_details['working_loc'],
            'contact_no'=>$input_details['emp_num_1'],
            'emp_num_2'=>$input_details['emp_num_2'],
            'rel_emp'=>$input_details['rel_emp'],
            'name_rel_ship'=>$input_details['name_rel_ship'],
            'emrg_con_num'=>$input_details['emrg_con_num'],
            'doj'=>$input_details['doj'],
            'blood_grp'=>$input_details['blood_grp'],
            'empID'=>$input_details['empID'],
            'email'=>$input_details['official_email'],
            'dob'=>$input_details['emp_dob'],
            'hr_action'=>'2',
            'hr_id_remark'=>'',
        ] );
        }

    }

    public function update_hr_idcard_remark( $input_details ){
        // echo "11<pre>";print_r($input_details);die;
        $update_roletbl = DB::table('customusers')->where( 'id', '=', $input_details['can_id_hr'] );
        $update_roletbl->update( [
            'hr_id_remark'=>$input_details['id_remark'],
            'hr_action'=>'3',
        ] );
    }




    public function check_user_status($id)
    {
             $result=CustomUser::select('hr_action')->where('empID',$id)->first();
             return $result;
    }
}
