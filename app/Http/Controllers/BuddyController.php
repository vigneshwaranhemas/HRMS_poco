<?php

namespace App\Http\Controllers;
use App\Repositories\IBuddyrepositories;
use App\Repositories\IPreOnboardingrepositories;
use Illuminate\Http\Request;
use Session;

class BuddyController extends Controller
{
    private $brep;

    public function __construct(IBuddyrepositories $brep,IPreOnboardingrepositories $preon){
         $this->brep=$brep;
         $this->preon = $preon;

    }
    public function buddy_dashboard()
    {
        return view('buddy.dashboard');
    }


    public function buddy_info()
    {
        $sess_info=Session::get("session_info");
        $id=$sess_info["empID"];
        $candidate_info=$this->brep->get_candidate_info($id);


    //    echo json_encode($candidate_info);

        return view('buddy.index')->with('candidate_info',$candidate_info);
    //    return view('buddy.index');
    }


    public function View_Buddy_feedback(Request $request)
  {
      $table="buddyfeedbackfields";
      $id=$request->id;
      $feedback_info=$this->brep->get_feedback_info($id);
      $fields=$this->preon->getonBoardingFields($table);
      $data["fields"]=$fields;
      $data['feedback_info']=$feedback_info;
      echo json_encode($data);
  }
}
