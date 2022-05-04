<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\CandidatePreOnBoardingModel;
use App\Models\userModel;
use App\Models\CustomUser;
use App\Models\Email_InfoModel;
use App\Models\Candidate_seating_and_email_request;
use App\Models\Candidate_Details;
use App\Models\EmailCreationModel;
use App\Models\UsersInfoModel;
use App\candidate_education_details;
use App\documents;
use App\Models\candidate_experience_details;
use App\Models\candidate_benefits_details;
use App\welcome_aboard;

use Illuminate\Support\Facades\Hash;


class HrPreonboardingrepositories implements IHrPreonboardingrepositories {
    public function getonboardinginfo($userid,$status){
            $result=CandidatePreOnBoardingModel::join('customusers','customusers.empID','=','candidate_preonboarding.emp_id')
                     ->where('customusers.pre_onboarding',1)
                     ->where('candidate_preonboarding.emp_id',$userid)->get();
             return $result;

    }

    public function get_candidate_info($id)
    {
        $result=CustomUser::join('candidate_details','customusers.cdID','=','candidate_details.cdID')
        ->where('candidate_details.created_by',$id["created_by"])
        ->where('customusers.pre_onboarding',1)
        ->select('customusers.empID','customusers.username',
                 'customusers.email','customusers.contact_no')
        ->get();
         return $result;
    }
    public function get_onboarding_candidate_info()
    {
        $result=CustomUser::join('candidate_details','customusers.cdID','=','candidate_details.cdID')
        ->where('candidate_details.or_doj',date('Y-m-d'))
        ->where('customusers.pre_onboarding',1)->get();
         return $result;
    }

    public function Update_mail_status($data)
    {
        foreach($data as $data1){
          $result=CustomUser::where("empID",$data1["empID"])->update($data1);
        }
        return $result;
    }

    public function DayWiseCandidateInfo($data)
    {
         $result=CustomUser::join("candidate_details",'candidate_details.cdID','=','customusers.cdID')
                 ->where("customusers.doj",$data['or_doj'])
                 ->where("customusers.pre_onboarding",1)
                 ->where("candidate_details.created_by",$data["created_by"])
                 ->select("candidate_details.cdID","customusers.empID","customusers.username",
                          "customusers.email","customusers.contact_no",
                          "customusers.Induction_mail","customusers.Buddy_mail")->get();
         return $result;
    }



    public function get_email_info(Type $var = null)
    {
        $result=Email_InfoModel::get();
        return $result;
    }

   public function Verify_emp_info($data)
   {
        $check_user=Candidate_seating_and_email_request::where('cdID',$data['cdID'])->first();
        $check_candidate_user=CustomUser::where('cdID',$data['cdID'])->first();
        $result['seating']=$check_user;
        $result['candidate']=$check_candidate_user;
        return $result;
   }

    public function Insert_Candidate_empId($data)
    {
        //  $check_user=Candidate_seating_and_email_request::where('cdID',$data['cdID'])->first();
        //  return $check_user;
    //      if($check_user){
    //             $final_response=array('success'=>'0','message'=>'EmployeeId Aldready Created for this Candidate');
    //      }
    //      else{
            $response=Candidate_seating_and_email_request::insert($data);
            if($response){
                  $data1["empID"]=$data["cdID"];
                  $data2=array('empID'=>$data['empId'],'passcode'=>$password = Hash::make("Welcome@123"));
                  $final_response=array('success'=>'1','message'=>'Candidate EmployeeID Created');

                   $update_preonboarding=CustomUser::join('candidate_preonboarding','customusers.empID','=','candidate_preonboarding.emp_id')
                                                    ->where('customusers.cdID',$data['cdID'])
                                                    ->select('candidate_preonboarding.id','candidate_preonboarding.emp_id')->get();
                    if(count($update_preonboarding)>0)
                    {
                        foreach($update_preonboarding as $onboard_info){
                            $onboard_result=CandidatePreOnBoardingModel::where("id",$onboard_info["id"])->update(['emp_id'=>$data['empId']]);
                        }
                    }
                    $result=CustomUser::where("cdID",$data1["empID"])->update($data2);
                    if($result)
                    {
                       $induction_info=Candidate_seating_and_email_request::join('candidate_details','candidate_details.cdID','=','Candidate_seating_and_email_requests.cdID')
                                                                            ->join('customusers','customusers.cdID','=','Candidate_seating_and_email_requests.cdID')
                                                                            ->where("candidate_details.cdID",$data["cdID"])
                                                                            ->select("customusers.username",
                                                                                     "candidate_details.created_by",
                                                                                     "customusers.email",
                                                                                     "customusers.department",
                                                                                     "customusers.doj",'customusers.empID',
                                                                                     'customusers.sup_emp_code',
                                                                                     'customusers.reviewer_emp_code')->first();
                       $work_location=CustomUser::select('worklocation','sup_name')->where('cdID',$data['cdID'])->first();
                       $induct_info['supervisor_info']=CustomUser::where('empID',$induction_info['sup_emp_code'])->select('email')->first();
                       $induct_info['reviewer_info']=CustomUser::where('empID',$induction_info['reviewer_emp_code'])->select('email')->first();
                       $email_info=Email_InfoModel::where('header_id',4)->first();
                       $admin_mail_info=Email_InfoModel::where('header_id',1)->first();
                       $induct_info['induction_info']=$induction_info;
                       $induct_info['email_info']=$email_info;
                       $induct_info['location']=$work_location;
                       $induct_info['admin_email_info']=$admin_mail_info;
                       $final_response=array('success'=>'1','message'=>$induct_info);
                  }
                  else{
                    $final_response=array('success'=>'2','message'=>'Problem in Creating EmployeeID');
                  }
            // }
         }



        return $final_response;
    }


    public function EmailIdCreation($data)
    {
        $email_table="";
        $result=CustomUser::join("candidate_details",'candidate_details.cdID','=','customusers.cdID')
        ->where("customusers.doj",$data['doj'])
        ->where("customusers.pre_onboarding",1)
        ->where("candidate_details.created_by",$data["created_by"])
        ->select("customusers.cdID","customusers.empID","customusers.username",
                 "customusers.email","customusers.contact_no")->get();
        if(count($result)>0){
            $i=1;
            foreach($result as $email_info){
                  $email_check=EmailCreationModel::where('empID',$email_info['empID'])->first();
                  if(!is_null($email_check)){
                                 if($email_check['status']==0){
                                     $status="";
                                     $check="<input type='checkbox'>";
                                 }
                                 else if($email_check['status']==1){
                                     $status="<span class='badge badge-warning'>In Progress</span>";
                                     $check="";
                                 }
                                 else{
                                   $status="<span class='badge badge-success'>Completed</span>";
                                   $check="";
                                 }
                                   $email_table.="<tr><td>".$i."</td><td>".$check."</td>
                                   <td>".$email_info['empID']."</td>
                                   <td>".$email_info['username']."</td>
                                   <td>".$email_info['email']."</td>
                                   <td class='text-center'>".$status."</td>
                                   <td>".$email_check["hr_suggested_mail"]."</td>
                                   <td>".$email_check["asset_type"]."</td>
                           </tr>";

                  }
                  else{
                               $email_table .="<tr><td>".$i."</td><td><input type='checkbox'><input type='hidden' value=".$email_info['empID']."></td>
                                               <td>".$email_info['empID']."</td>
                                               <td>".$email_info['username']."</td>
                                               <td>".$email_info['email']."</td>
                                               <td class='text-center'><input type='hidden' value=0></td>
                                               <td><input type='text' class='form-control tdtextwidth'></td>
                                               <td><select class='form-control'>
                                                       <option value=0>Choose</option>
                                                       <option value='Laptop'>Laptop</option>
                                                       <option value='Desktop'>Desktop</option>
                                                   </select>
                                               </td>
                                          </tr>";
                  }
               $i++;
            }
           echo $email_table;
        }
        else{
            echo "1";
        }
    }


    public function get_itinfra_email_info()
    {
           $email_info=Email_InfoModel::where('header_id',3)->first();
           return $email_info;
    }
    public function candidate_info_for_EmailCreation($data)
    {
         $candidate_info=CustomUser::where('empID',$data['empID'])->first();
         $candidate_data['supervisor_info']=CustomUser::where('empID',$candidate_info->sup_emp_code)->first();
         $candidate_data['reviewer_info']=CustomUser::where('empID',$candidate_info->reviewer_emp_code)->first();
         $candidate_data['info']=$candidate_info;
         $Insert_email_info=EmailCreationModel::insert($data);
         return $candidate_data;
    }
    public function get_hrRequested_info($status)
    {
         $email_info=EmailCreationModel::join('customusers','customusers.empID','=','candidate_email_request.empID')
                                       ->where('candidate_email_request.status',$status)
                                       ->select("customusers.cdID","customusers.empID","customusers.username",
                                              "customusers.email","customusers.contact_no",
                                              "candidate_email_request.hr_suggested_mail",
                                              "candidate_email_request.asset_type")->get();
         return $email_info;
    }
    public function getUserDocuments($id)
    {
        $user_documents=CustomUser::join('candidate_education_details','customusers.cdID','=','candidate_education_details.cdID')
                                   ->join('candidate_experience_details','customusers.cdID','=','candidate_experience_details.cdID')
                                   ->join('candidate_benefits_details','customusers.cdID','=','candidate_benefits_details.cdID')
                                   ->join('documents','customusers.cdID','=','documents.cdID')
                                   ->where('customusers.cdId',$id)
                                   ->select('candidate_education_details.edu_certificate as education_details',
                                          'candidate_experience_details.certificate as experience',
                                          'candidate_benefits_details.doc_filename as benefites',
                                          'documents.doc_name as documents',
                                          'documents.path as doc_path',
                                          'customusers.doc_status')->first();
        return $user_documents;
    }
    public function update_candidate_doc_status($id,$status)
    {
        $result=CustomUser::where("empID",$id)->update($status);
        return $result;
    }

    public function get_welcome_aboard_details_hr($id){

        $welcome_aboard_data = welcome_aboard::where('created_by',$id)
                                                ->first();

        return $welcome_aboard_data;
    }

}


?>
