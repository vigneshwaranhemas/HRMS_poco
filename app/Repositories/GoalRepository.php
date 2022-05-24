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
   public function fetchGoalIdDetails( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('goal_process');
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
   public function checkCustomUserSuperList(){
      $logined_empID = Auth::user()->empID;        
      $logined_username = Auth::user()->username;        
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('sup_name', $logined_username)->value('empID');
      
      if(!empty($response)){
         $response = "Yes";
      }else{
         $response = "No";
      }
      return $response;
   }

}
