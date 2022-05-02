<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class CommonRepositories implements ICommonRepositories
{
	public function get_candidate_info_hr( $input_details ){

        $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('id', '=', $input_details['id'])
        ->get();
        // echo "<pre>";print_r($bandtbl);die;
        return $bandtbl;
    }

    public function update_hr_idcard_info( $input_details ){
// echo "11<pre>";print_r($input_details);die;
        $update_roletbl = DB::table('customusers')->where( 'id', '=', $input_details['can_id'] );
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
            'hr_action'=>'1',
        ] );
    }
}