<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Goals;
use Auth;
use App\Models\CustomUser;
class GoalRepository implements IGoalRepository
{

   public function add_goals_insert( $data ){
      $response = Goals::insertGetId($data);
      return $response;
   }
   public function insertGoalsCode($goal_unique_code, $last_inserted_id){
        $logined_empID = Auth::user()->empID;
        $response = Goals::where('id', $last_inserted_id)
                  ->where('created_by', $logined_empID)
                  ->update([
                        'goal_unique_code' => $goal_unique_code
                  ]);
      return $response;
   }
   public function get_hr_goal_list_tb($input_details){
       // DB::enableQueryLog();
      if($input_details['supervisor_list'] != ''){
         // $logined_empID = Auth::user()->empID;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        // ->where('cs.reviewer_emp_code', $logined_empID)
                        ->where('cs.empID', $input_details['supervisor_list'])
                        ->get();
      }else{
         $logined_empID = Auth::user()->empID;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $logined_empID)
                        ->where('cs.reviewer_emp_code', "900531")
                        ->get();

      }
      // dd(DB::getQueryLog());
      return $response;
   }
    public function get_goal_list(){

        $logined_empID = Auth::user()->empID;

        $response = Goals::select('*')

                ->where('created_by', $logined_empID)

                ->get();

        return $response;

    }
    public function get_goal_myself_list(){

        $logined_empID = Auth::user()->empID;

        $response = Goals::select('*')

                ->where('created_by', $logined_empID)

                ->get();

        return $response;

    }

   public function get_team_member_goal_list($input_details){

      if($input_details['team_member_filter'] != ''){
         $logined_empID = Auth::user()->empID;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $logined_empID)
                        ->where('cs.empID', $input_details['team_member_filter'])
                        ->get();
      }else{
         $logined_empID = Auth::user()->empID;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $logined_empID)
                        ->get();
      }

      return $response;
   }
   public function get_reviewer_goal_list($input_details){

      if($input_details['team_leader_filter'] != ''){
         $logined_empID = Auth::user()->empID;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        // ->where('cs.reviewer_emp_code', $logined_empID)
                        // ->where('cs.sup_emp_code', $input_details['team_leader_filter'])
                        ->where('cs.sup_emp_code', $logined_empID)
                        ->where('cs.empID', $input_details['team_leader_filter'])
                        ->get();
      }else{
         $logined_empID = Auth::user()->empID;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $logined_empID)
                        ->where('cs.reviewer_emp_code', "900531")
                        ->get();
         // $response = DB::table('goals')
         //                ->distinct()
         //                ->get();
      }

      return $response;
   }
   public function get_team_member_drop_list( $id ){
      // DB::enableQueryLog();
      $bandtbl = DB::table('customusers')
      ->select('*')
      ->where('sup_emp_code', '=', $id)
      ->get();
      // dd(DB::getQueryLog());
      return $bandtbl;
   }
   public function get_bh_goal_list($input_details){

      $logined_empID = Auth::user()->empID;

      if($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter'] != '' && $input_details['team_member_filter'] != ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter'])
                        ->where('cs.empID', $input_details['team_member_filter'])
                        ->where('g.supervisor_status','1')
                        ->where('g.reviewer_status','1')
                        ->get();

      }elseif($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter'] != '' && $input_details['team_member_filter'] == ''){



         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter'])
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter'])
                        ->where('g.supervisor_status','1')
                        ->where('g.reviewer_status','1')
                        ->get();
        //   echo json_encode($response);die();


      }elseif($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter'] == '' && $input_details['team_member_filter'] == ''){


         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter'])
                        ->where('g.supervisor_status','1')
                        ->where('g.reviewer_status','1')
                        ->get();


      }elseif($input_details['reviewer_filter'] == '' && $input_details['team_leader_filter'] == '' && $input_details['team_member_filter'] == ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $logined_empID)
                        ->where('cs.reviewer_emp_code', "900531")
                        ->get();
         // $response = DB::table('goals')
         //                ->distinct()
         //                ->get();
      }

      return $response;
   }
   public function fetchGoalIdDetails( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('goal_process');
      // echo "1<pre>";print_r($response);die;
      return $response;
   }
   public function Fetch_goals_user_info($id)
   {
        $user_info=Goals::join('customusers','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$id)
        ->select('customusers.*')->first();
        return $user_info;

   }
   public function checkSupervisorIDOrNot( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      // echo "1<pre>";print_r($id);die;
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
      return $response;
   }
   public function checkReviewerIDOrNot( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      $logined_empID = Auth::user()->empID;
      $supervisor = DB::table('customusers')->where('reviewer_emp_code', $logined_empID)->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
      $teamleader=CustomUser::where('sup_emp_code','!=',$logined_empID)->where('reviewer_emp_code',$logined_empID)->where('empID',$empID)->value('empID');
      $result=0;
      if($supervisor){
           $result=1;
      }
      if($teamleader){
          $result=2;
      }
    //   echo json_encode($empID);die();
      return $result;
   }
   public function fetchGoalIdHead( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('goal_name');
      return $response;
   }
   public function goals_consolidate_rate_head( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('employee_consolidated_rate');
      return $response;
   }
   public function goals_sup_consolidate_rate_head( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('supervisor_consolidated_rate');
      return $response;
   }
   public function fetchGoalIdDelete( $id ){
      $response = Goals::where('goal_unique_code', $id)->delete();
      return $response;
   }
   public function add_goals_update($data){
        $logined_empID = Auth::user()->empID;
        $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                  ->where('created_by', $logined_empID)
                  ->update([
                        'goal_process' => $data['goal_process']
                  ]);
      return $response;
   }
   public function update_goals_sup($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              'goal_process' => $data['goal_process'],
                              'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate']
                        ]);
    return $response;
 }
   public function goals_status_update($data){
        $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                  ->update([
                        'goal_status' => $data['goal_status']
                  ]);
      return $response;
   }
   public function add_goal_btn(){
      $logined_empID = Auth::user()->empID;
      $response1 = Goals::where('created_by', $logined_empID)->where('goal_status', 'Pending')->value('goal_name');
      $response2 = Goals::where('created_by', $logined_empID)->where('goal_status', 'Revert')->value('goal_name');
      // dd($response2);
      if(!empty($response1) || !empty($response2)){
         // dd("y");
         $response = "Yes";
      }else{
         // dd("n");
         $response = "No";
      }
      return $response;
   }
   public function checkCustomUserList(){
      $logined_empID = Auth::user()->empID;
      $logined_username = Auth::user()->username;
      $reviewer = DB::table('customusers')->where('reviewer_emp_code', $logined_empID)->where('reviewer_name', $logined_username)->value('empID');
      $supervisor = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('sup_name', $logined_username)->value('empID');

      if(!empty($reviewer)){
         $response = "Reviewer";
      }elseif(!empty($supervisor)){
         $response = "Supervisor";
      }else{
         $response = "no";
      }
      return $response;
   }
   public function fetchSupervisorList(){
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->get();
      return $response;
   }
   public function fetchReviewerList(){
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('reviewer_emp_code', "900531")->get();

      return $response;
   }
  /* public function fetchHrList(){
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('reviewer_emp_code', "900380")->get();
      return $response;
   }*/
   public function fetch_supervisor_filter($supervisor_filter){
      if($supervisor_filter != ''){
         $customusers = DB::table('customusers')->where('sup_emp_code', $supervisor_filter)->get();
         $output = '';
         $output .= '<option value="">...Select...</option>';
         foreach($customusers as $record){
            $output .= '<option value="'.$record->empID.'">'.$record->username.'</option>';
         }
      }
      return $output;
   }
   public function fetch_reviewer_filter($reviewer_filter){
      if($reviewer_filter != ''){
         $customusers = DB::table('customusers')->where('sup_emp_code', $reviewer_filter)->get();
         $output = '';
         $output .= '<option value="">...Select...</option>';
         foreach($customusers as $record){
            $output .= '<option value="'.$record->empID.'">'.$record->username.'</option>';
         }
      }
      return $output;
   }
   public function fetch_team_leader_filter($team_leader_filter){
      if($team_leader_filter != ''){
         $customusers = DB::table('customusers')->where('sup_emp_code', $team_leader_filter)->get();
         $output = '';
         $output .= '<option value="">...Select...</option>';
         foreach($customusers as $record){
            $output .= '<option value="'.$record->empID.'">'.$record->username.'</option>';
         }
      }
      return $output;
   }
   public function addGoalEmployeeSummary($id, $employee_summary){
        $logined_empID = Auth::user()->empID;
        $response = Goals::where('goal_unique_code', $id)
                  ->where('created_by', $logined_empID)
                  ->update([
                        'employee_summary' => $employee_summary
                  ]);
      return $response;
   }
   public function check_goals_employee_summary($id){
      $result = Goals::where('goal_unique_code', $id)->value('employee_summary');
      if(!empty($result)){
         $response = "Yes";
      }else{
         $response = "No";
      }
      return $response;
   }
   public function fetch_goals_employee_summary($id){
      $response = Goals::where('goal_unique_code', $id)->value('employee_summary');
      return $response;
   }

    public function get_supervisor_data( $id ){
       $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('sup_emp_code', '=', $id)
        ->get();
        return $bandtbl;
   }
   public function fetch_team_member_list( $id ){
       // echo "<pre>w";print_r($id);die;
      // DB::enableQueryLog();
       $bandtbl = DB::table('customusers')
           ->select('*')
           ->where('reviewer_emp_code', $id)
           ->get();
      // dd(DB::getQueryLog());
           return $bandtbl;

   }
   public function fetch_reviewer_res_data( $id ){
      // DB::enableQueryLog();
       $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('sup_emp_code', '=', $id)
        ->get();
      // dd(DB::getQueryLog());
        return $bandtbl;
   }
   public function fetch_reviewer_tab_data( $input_details ){
      // echo "<pre>";print_r($input_details);die;
       if($input_details['supervisor_list_1'] != ''  || $input_details['team_member_filter'] != '' ){
         // echo "<pre>";print_r("222");die;
         // $logined_empID = Auth::user()->empID;
          $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        // ->where('cs.reviewer_emp_code', $logined_empID)
                        ->where('cs.reviewer_emp_code', $input_details['supervisor_list_1'])
                        ->where('cs.empID', $input_details['team_member_filter'])
                        ->get();
      }else{
         $logined_empID = Auth::user()->empID;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('*')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $logined_empID)
                        ->get();

      }

      // dd(DB::getQueryLog());
      return $response;
   }

   public function get_supervisor_hr( $id ){
    // DB::enableQueryLog();
    $bandtbl = DB::table('customusers')
    ->select('*')
    ->where('reviewer_emp_code', '=', $id)
    ->where('sup_emp_code', '=', $id)
    ->get();
    // dd(DB::getQueryLog());
    return $bandtbl;
    }

    public function get_hr_goal_list_for_tbl($input_details){



        $logined_empID = Auth::user()->empID;



        if($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter_hr'] != '' && $input_details['team_member_filter_hr'] != ''){



        $response = DB::table('customusers as cs')
        ->distinct()
        ->select('g.*')
        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter'])
        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr'])
        ->where('cs.empID', $input_details['team_member_filter_hr'])
        ->get();



        }elseif($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter_hr'] != '' && $input_details['team_member_filter_hr'] == ''){





        $response = DB::table('customusers as cs')
        ->distinct()
        ->select('g.*')
        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr'])
        ->get();



        }elseif($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter_hr'] == '' && $input_details['team_member_filter_hr'] == ''){



        $response = DB::table('customusers as cs')
        ->distinct()
        ->select('g.*')
        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
        ->where('cs.sup_emp_code', $input_details['reviewer_filter'])
        ->get();



        }elseif($input_details['reviewer_filter'] == '' && $input_details['team_leader_filter_hr'] == '' && $input_details['team_member_filter_hr'] == ''){



        $response = DB::table('customusers as cs')
        ->distinct()
        ->select('g.*')
        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
        ->where('cs.sup_emp_code', "900531")
        // ->where('cs.sup_emp_code', $logined_empID)
        ->where('cs.reviewer_emp_code', "900531")
        ->get();

        }



        return $response;
        }

    public function get_manager_lsit( $id ){
        // DB::enableQueryLog();
        $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('sup_emp_code', '=', $id)
        ->get();
        // dd(DB::getQueryLog());
        return $bandtbl;
   }
   public function gethr_list_tab_record($input_details){

      $logined_empID = Auth::user()->empID;

      if($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] != '' && $input_details['gender_hr_1'] != ''&& $input_details['grade_hr_1'] != '' && $input_details['department_hr_1'] != ''){
         // echo "<pre>";print_r("expression0");die;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->where('cs.empID', $input_details['team_member_filter_hr_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }elseif($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == ''&& $input_details['gender_hr_1'] != ''&& $input_details['grade_hr_1'] != '' && $input_details['department_hr_1'] != ''){
         // echo "<pre>";print_r("expression3");die;

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }elseif($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' &&$input_details['gender_hr_1'] != ''  && $input_details['grade_hr_1'] == '' && $input_details['department_hr_1'] != ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] != '' && $input_details['department_hr_1'] != ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }elseif( $input_details['reviewer_filter_1'] == '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] != '' && $input_details['grade_hr_1'] != '' && $input_details['department_hr_1'] != ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }
      /*single textbox notempty*/
      elseif($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == ''&& $input_details['gender_hr_1'] == ''&& $input_details['grade_hr_1'] == '' && $input_details['department_hr_1'] == ''){
         // echo "<pre>";print_r($input_details['reviewer_filter_1']);die;
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $input_details['reviewer_filter_1'])
                        ->get();

      }elseif( $input_details['reviewer_filter_1'] == '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] != '' && $input_details['grade_hr_1'] == ''&& $input_details['department_hr_1'] == ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                       ->where('cs.gender', $input_details['gender_hr_1'])
                        ->get();

      }elseif( $input_details['reviewer_filter_1'] == '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] != ''&& $input_details['department_hr_1'] == ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                       ->where('cs.grade', $input_details['grade_hr_1'])
                        ->get();

      }elseif( $input_details['reviewer_filter_1'] == '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] == ''&& $input_details['department_hr_1'] != ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }
      /*only 2 notempty*/
      elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] == ''&& $input_details['department_hr_1'] != ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }elseif( $input_details['reviewer_filter_1'] == '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] != '' && $input_details['grade_hr_1'] == '' && $input_details['department_hr_1'] != ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }elseif( $input_details['reviewer_filter_1'] == '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] != ''&& $input_details['department_hr_1'] != ''){

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();

      }elseif($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] == ''&& $input_details['gender_hr_1'] == ''&& $input_details['grade_hr_1'] == '' && $input_details['department_hr_1'] == ''){
         // echo "<pre>";print_r("expression2");die;

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->get();

      }elseif($input_details['reviewer_filter_1'] == '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == ''&& $input_details['gender_hr_1'] != ''&& $input_details['grade_hr_1'] != '' && $input_details['department_hr_1'] == ''){
         // echo "<pre>";print_r("expression2");die;

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->get();

      }elseif($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == ''&& $input_details['gender_hr_1'] != ''&& $input_details['grade_hr_1'] == '' && $input_details['department_hr_1'] == ''){
         // echo "<pre>";print_r("expression2");die;

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->get();

      }

      /*only 3notempty*/
      elseif($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == ''&& $input_details['gender_hr_1'] != ''&& $input_details['grade_hr_1'] != '' && $input_details['department_hr_1'] == ''){
         // echo "<pre>";print_r("expression2");die;

         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->get();

      }elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] != '' && $input_details['grade_hr_1'] == ''&& $input_details['department_hr_1'] == ''){
         // DB::enableQueryLog();
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->get();
      }elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] != '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] == ''&& $input_details['department_hr_1'] == ''){
         // DB::enableQueryLog();
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->where('cs.empID', $input_details['team_member_filter_hr_1'])
                        ->get();
         // dd(DB::getQueryLog());
      }
      /*only 4 notempty*/
      elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] != '' && $input_details['gender_hr_1'] != '' && $input_details['grade_hr_1'] == ''&& $input_details['department_hr_1'] == ''){
         // DB::enableQueryLog();
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->where('cs.empID', $input_details['team_member_filter_hr_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->get();
      }elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] != '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] != ''&& $input_details['department_hr_1'] == ''){
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->where('cs.empID', $input_details['team_member_filter_hr_1'])
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->get();
      }elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] != '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] == ''&& $input_details['department_hr_1'] != ''){
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->where('cs.empID', $input_details['team_member_filter_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();
      }
      /*only 5notempty*/
      elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] != '' && $input_details['grade_hr_1'] != ''&& $input_details['department_hr_1'] != ''){
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->where('cs.department', $input_details['department_hr_1'])
                        ->get();
         }elseif( $input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1'] != '' && $input_details['team_member_filter_hr_1'] != '' && $input_details['gender_hr_1'] != '' && $input_details['grade_hr_1'] != ''&& $input_details['department_hr_1'] == ''){
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.reviewer_emp_code', $input_details['reviewer_filter_1'])
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1'])
                        ->where('cs.empID', $input_details['team_member_filter_hr_1'])
                        ->where('cs.gender', $input_details['gender_hr_1'])
                        ->where('cs.grade', $input_details['grade_hr_1'])
                        ->get();
         }elseif($input_details['reviewer_filter_1'] == '' && $input_details['team_leader_filter_hr_1'] == '' && $input_details['team_member_filter_hr_1'] == '' && $input_details['gender_hr_1'] == '' && $input_details['grade_hr_1'] == '' && $input_details['department_hr_1'] == ''){
         $val = '1';
         // DB::enableQueryLog();
         $response = DB::table('customusers as cs')
                        ->distinct()
                        ->select('g.*','cs.grade','cs.gender','cs.department')
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', "900531")
                        // ->where('cs.sup_emp_code', $logined_empID)
                        ->where('cs.reviewer_emp_code', "900531")
                        ->get();
      }

      return $response;
   }
/*after cick in hr submit button*/

   public function get_reviewer_goal_list_for_reviewer($input_details){

    if($input_details['team_leader_filter_for_reviewer'] != ''  && $input_details['team_member_filter'] != ''){
       $logined_empID = Auth::user()->empID;
       $response = DB::table('customusers as cs')
                      ->distinct()
                      ->select('g.*')
                      ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                    //   ->where('cs.reviewer_emp_code', $logined_empID)
                      ->where('cs.sup_emp_code', $input_details['team_leader_filter_for_reviewer'])
                      ->where('cs.empID', $input_details['team_member_filter'])
                      ->where('g.supervisor_status', "1")
                      ->get();
    }elseif($input_details['team_leader_filter_for_reviewer'] != ''  && $input_details['team_member_filter'] == '')
    {
       $logined_empID = Auth::user()->empID;
       $response = DB::table('customusers as cs')
                      ->distinct()
                      ->select('g.*')
                      ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                      ->where('cs.sup_emp_code', $input_details['team_leader_filter_for_reviewer'])
                      ->where('g.supervisor_status', "1")
                      ->get();
    }
    else{
       $logined_empID = Auth::user()->empID;
       $response = DB::table('customusers as cs')
                      ->distinct()
                      ->select('g.*')
                      ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                      ->where('cs.reviewer_emp_code', $logined_empID)
                    //   ->where('cs.sup_emp_code', $logined_empID)
                    //   ->where('cs.reviewer_emp_code', "900531")
                    ->where('g.supervisor_status', "1")
                      ->get();
    }

    return $response;
 }

   public function checkHrReviewerIDOrNot( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      $logined_empID = Auth::user()->empID;
      $supervisor = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
      $teamleader=CustomUser::where('sup_emp_code','!=',$logined_empID)->where('reviewer_emp_code',$logined_empID)->where('empID',$empID)->value('empID');
      $result=0; //others
      if($supervisor){
           $result=1;
      }
      if($teamleader){
          $result=2;
      }
    //   echo json_encode($empID);die();
      return $result;
   }

   public function get_goal_setting_reviewer_details_tl( $input_details ){

    $id = $input_details['id'];
    // echo '<pre>';print_r($id);die();

    // DB::enableQueryLog();

    $reviewer_details_tl = DB::table('goals as gl')
                        // ->distinct()
                        // ->select('gl.*')
                        ->join('customusers as cu', 'gl.created_by', '=', 'cu.empID')
                        ->where('gl.goal_unique_code', $input_details['id'])
                        ->get();
    // dd(DB::getQueryLog());

    return $reviewer_details_tl;
}

public function update_goals_sup_reviewer_tm($data){
    $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                      ->update([
                            'goal_process' => $data['goal_process'],
                      ]);
  return $response;
}

}
