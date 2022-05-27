<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Goals; 
use Auth;

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
   public function get_goal_list(){
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
                        ->where('cs.reviewer_emp_code', $logined_empID)
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter'])
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
                        ->get();

      }elseif($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter'] != '' && $input_details['team_member_filter'] == ''){
        
         $response = DB::table('customusers as cs')
                        ->distinct()         
                        ->select('g.*')         
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $input_details['team_leader_filter'])
                        ->get();

      }elseif($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter'] == '' && $input_details['team_member_filter'] == ''){
        
         $response = DB::table('customusers as cs')
                        ->distinct()         
                        ->select('g.*')         
                        ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                        ->where('cs.sup_emp_code', $input_details['reviewer_filter'])
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
   public function checkSupervisorIDOrNot( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      $logined_empID = Auth::user()->empID;        
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');   
      return $response;
   }
   public function checkReviewerIDOrNot( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      $logined_empID = Auth::user()->empID;        
      $response = DB::table('customusers')->where('reviewer_emp_code', $logined_empID)->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');      
      return $response;
   }
   public function fetchGoalIdHead( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('goal_name');
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

}
