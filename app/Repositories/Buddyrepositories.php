<?php

namespace App\Repositories;


use App\Models\CustomUser;
use App\Models\BuddyFeedbackModel;


class Buddyrepositories implements IBuddyrepositories{


  public function get_candidate_info($id)
  {
            $result=CustomUser::join("candidate_details","candidate_details.cdId",'=','customusers.empID')
            ->where('candidate_details.welcome_buddy',$id)
            ->where('customusers.pre_onboarding',1)->get();

            return $result;
        }


public function get_feedback_info($id)
{
          $result=BuddyFeedbackModel::where('empId',$id)->get();
          return $result;
}

}




?>
