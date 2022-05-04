<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\CandidatePreOnBoardingModel;
use App\Models\BuddyFeedbackModel;
use App\Models\CustomUser;
use App\Models\UsersInfoModel;
use App\welcome_aboard;

class PreOnboardingrepositories implements IPreOnboardingrepositories {
     public function Check_onBoard($table,$test)
     {
         $response=DB::table($table)->where($test)->get();
         return $response;
     }
     public function getonBoardingFields($table)
     {
        $response=DB::table($table)->get();
        return $response;
     }
     public function insert_onboard($data)
     {
         $response=CandidatePreOnBoardingModel::insert($data);
         return $response;
     }
     public function update_onboard($data,$id,$field)
     {
         $i=0;
         foreach($data as $onboard)
         {
              $id=$field[$i]->id;
            CandidatePreOnBoardingModel::where('id',$id)->update($onboard);

         $i++;
        }
         $response="success";
         return $response;
     }

   public function insert_buddy_feedback($data,$data1)
   {
          $response=BuddyFeedbackModel::insert($data);
          if($response){
          $response=BuddyFeedbackModel::insert($data1);

          }
            //   $response=DB::table("buddy_feedback_models")->insert($data);
          return $response;
   }
   public function get_buddy_info($id)
   {
        $response=BuddyFeedbackModel::where($id)->get();
        return $response;
   }
   public function get_canidate_info($table,$test)
   {
        $response=DB::table($table)->where($test)->first();
        return $response;
   }
   public function fetch_buddy_info($data)
   {
          $result=CustomUser::join('candidate_details','candidate_details.welcome_buddy','=','customusers.empID')
                                  ->where('candidate_details.cdID',$data)
                                  ->select('customusers.empID','customusers.username','customusers.designation',
                                  'customusers.email','customusers.contact_no')
                                  ->first();
          return $result;
   }

     // Welcome aboard process start
    public function add_welcome_aboard_process( $form_data ){

        $response = welcome_aboard::insert($form_data);
        return $response;
      }

    public function get_welcome_aboard_details($data){
        // echo '<pre>';print_r($data);die();

        // $welcome_aboard_data = welcome_aboard::first();
        $welcome_aboard_data = welcome_aboard::where('created_by',$data)
                                                ->first();

        return $welcome_aboard_data;
    }
    // Welcome aboard process End


 //get candidate and buddy info for buddy feedback work  done by vignesh

            public function get_candidate_and_buddy_info($data)
            {
                // $result=CustomUser::join('candidate_details','customusers.cdID','=','candidate_details.cdID')
                //                     ->join('users','users.empID','=','candidate_details.welcome_buddy')
                //                     ->where('customusers.cdID',$data['cdID'])
                //                     ->select('customusers.empID','customusers.username',
                //                              'customusers.department','customusers.designation',
                //                              'customusers.worklocation','customusers.doj','users.name')->first();
                    $result=CustomUser::join('candidate_details','customusers.cdID','=','candidate_details.cdID')
                                    ->join('customusers as cs','cs.empID','=','candidate_details.welcome_buddy')
                                    ->where('customusers.cdID',$data['cdID'])
                                    ->select('cs.username as buddy_name','customusers.empID',
                                             'customusers.username','customusers.department',
                                             'customusers.designation','customusers.worklocation',
                                             'customusers.doj')->first();
                    return $result;
            }






}


?>
