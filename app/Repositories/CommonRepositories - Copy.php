<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\CustomUser;
use App\Models\StickyNotesModel;
use App\Goals;

class CommonRepositories implements ICommonRepositories
{
	public function get_candidate_info_hr( $input_details ){
        // echo "11<pre>";print_r($input_details);die;
       $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('id', '=', $input_details['id'])
        ->get();
        return $bandtbl;
    }
    public function get_candidate_info_hr2( $input_details ){
        $bandtbl = DB::table('customusers as cs')
        ->select('*')
        ->where('cs.empID', '=', $input_details['empID'])
        ->get();
        return $bandtbl;
    }
    public function account_hr_info( $input_details ){

        $bandtbl = DB::table('candidate_account_information')
        ->select('*')
        ->where('emp_id', '=', $input_details['empID'])
        ->get();
        return $bandtbl;
    }
    public function education_hr_info( $input_details ){

        $bandtbl = DB::table('candidate_education_details')
        ->select('*')
        ->where('emp_id', '=', $input_details['empID'])
        ->get();
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
            'p_email'=>$input_details['p_email'],
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
            'p_email'=>$input_details['p_email'],
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

    public function check_user_status($id){
        $result=CustomUser::select('hr_action','pms_status')->where('empID',$id)->first();
        return $result;
    }
    public function check_user_status_pms($id){
        $result=goals::select('employee_status')->where('created_by',$id)->first();
        return $result;
    }
    public function user_status_pms($id){
        // echo "<pre>";print_r($id);die;
        // DB::enableQueryLog();
             $result=Goals::select('employee_status')->where('created_by',$id)->first();
             // dd(\DB::getQueryLog()); 
             return $result;
    }

    public function get_organization_info()
    {
        $organisation['reviewer']=CustomUser::select('empID','username','img_path','designation')->where('sup_name','CKR')->first();
        $organisation['supervisors']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$organisation['reviewer']->empID)->get();
        foreach($organisation['supervisors'] as $supervisors){
          $team_leaders[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$supervisors['empID'])->get();
        }
        $organisation['team_leaders']=$team_leaders;
        foreach($organisation['team_leaders'] as $teamleaders){
            foreach($teamleaders as $leaders)
            {
                      $emp[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$leaders['empID'])->get();

            }
        }
      $organisation['employees']=$emp;
        return $organisation;
    }
    public function get_organization_info_one()
    {
        $organisation['reviewer']=CustomUser::select('empID','username','img_path','designation')->where('sup_name','CKR')->first();
        $organisation['supervisors']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$organisation['reviewer']->empID)->get();
        foreach($organisation['supervisors'] as $supervisors){
          $team_leaders[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$supervisors['empID'])->get();
        }
        $organisation['team_leaders']=$team_leaders;
        foreach($organisation['team_leaders'] as $teamleaders){
              foreach($teamleaders as $leaders)
              {
                        $emp[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$leaders['empID'])->get();

              }
          }
        $organisation['employees']=$emp;
        return $organisation;
    }
    public function supervisor_wise_info($id)
    {
        $organisation=CustomUser::select('empID','username','img_path','designation')->where('sup_name','CKR')->first();
        $supervisor['supervisors']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$id)->get();
        $supervisor['supervisor_info']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('empID',$id)->first();
        $supervisor['team_leaders']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$id)->get();
        foreach($supervisor['team_leaders'] as $teamleaders){
            $emp[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$teamleaders['empID'])->get();
          }
        $supervisor['employees']=$emp;
        return $supervisor;
    }
    public function change_password_process( $form_credentials ){

        $update_mdlusertbl = new CustomUser();
        $update_mdlusertbl = $update_mdlusertbl->where( 'empID', '=', $form_credentials['empID'] );

        $update_mdlusertbl->update( [
            'passcode' => $form_credentials['confirm_password'],
            'passcode_status' => $form_credentials['passcode_status']
        ] );
    }

   /* public function update_reset_pass( $data ){
        // echo "22<pre>";print_r($data);die;

        $update_mdlusertbl = new CustomUser();
        $update_mdlusertbl = $update_mdlusertbl->where( 'empID', '=', $data['empID'] );

        $update_mdlusertbl->update( [
            'passcode_token' => $data['passcode_token'],
        ] );
    }*/
    public function update_password( $data ){

        $update_mdlusertbl = new CustomUser();
        $update_mdlusertbl = $update_mdlusertbl->where( 'empID', '=', $data['emp_id'] );

        $update_mdlusertbl->update( [
            'passcode' => $data['passcode'],
        ] );
    }

    public function Store_StickyNotes($data)
    {
        $result=StickyNotesModel::insert($data);
        return $result;
    }
    public function Fetch_Notes($data)
    {
         $result=StickyNotesModel::select('id','empID','Notes','color','updated_at')->where($data)->get();
         if($result){
             return $result;
         }
         else{
             return false;
         }
    }
    public function Fetch_Notes_id_wise($data)
    {
        $result=StickyNotesModel::select('id','empID','Notes','color','updated_at')->where($data)->first();
         if($result){
             return $result;
         }
         else{
             return false;
         }
    }
    public function Update_Notes_id_wise($data,$id)
    {
        $result=StickyNotesModel::where('id',$id)->update($data);
        if($result){
            return $result;
        }
        else{
            return false;
        }

    }
    public function pms_oneor_not($id)
    {
         $result=CustomUser::select('pms_status')->where('empID',$id)->first();
        return $result;
    }
    public function Delete_Notes_id_wise($coloumn,$id)
    {
        $result = StickyNotesModel::where($coloumn, $id)->delete();
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }


    public function my_team_tl_info($id){
        // echo "<pre>";print_r($id);die;
         // $organisation=CustomUser::select('empID','username','img_path','designation')->where('sup_name','CKR')->first();
        // DB::enableQueryLog();

        $supervisor=CustomUser::select('empID','username','img_path','sup_emp_code','designation')
                                ->where('sup_emp_code',$id)
                                ->get();

         // echo "<pre>";print_r($supervisor);die;                       

        // dd(DB::getQueryLog());

        // $supervisor['supervisor_info']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('empID',$id)->first();
        // $supervisor['team_leaders']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$id)->get();
        // foreach($supervisor['team_leaders'] as $teamleaders){
        //     $emp[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$teamleaders['empID'])->get();
        //   }
        // $supervisor['employees']=$emp;
        return $supervisor;

    }
    public function pms_submit($id,$val){
        // echo "<pre>";print_r($val);die;
        $update_roletbl = DB::table('customusers')->where( 'empID', '=', $id );
        $update_roletbl->update( [
            'pms_status'=>$val,
        ] );

    }
}
