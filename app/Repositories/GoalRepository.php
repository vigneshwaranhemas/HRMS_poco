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

}
