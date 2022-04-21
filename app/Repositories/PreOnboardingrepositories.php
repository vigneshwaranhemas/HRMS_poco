<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\CandidatePreOnBoardingModel;
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
        //   echo '<pre>';print_r($response);

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

     // Welcome aboard process start
    public function add_welcome_aboard_process( $form_data ){

        $response = welcome_aboard::insert($form_data);
        return $response;
      }

    public function get_welcome_aboard_details(){

        $welcome_aboard_data = welcome_aboard::first();

        return $welcome_aboard_data;
    }
    // Welcome aboard process End

}


?>
