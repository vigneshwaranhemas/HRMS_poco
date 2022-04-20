<?php

namespace App\Http\Controllers;
use App\Repositories\IHrPreonboardingrepositories;

use Illuminate\Http\Request;

class ItInfraController extends Controller
{


    public function __construct(IHrPreonboardingrepositories $hpreon)
    {
        $this->hpreon = $hpreon;

    }
    public function index()
    {
        return view('ItInfra.dashboard');
    }

    public function EmailIdCreation()
    {
        $status=1;
        $email_info['pending']=$this->hpreon->get_hrRequested_info($status);
        $status=2;
        $email_info['completed']=$this->hpreon->get_hrRequested_info($status);
        // $email_info=$this->hpreon->get_hrRequested_info();
        //   echo json_encode($email_info);
          return view('ItInfra.EmailIdCreation')->with('email_info',$email_info);
    }

    public function ITInfra_Email_Creation(Request $request)
    {
          $email_updation=$this->hpreon->update_itInfra_EmailStatus($request->empID);
          return $email_updation;
    }


}
