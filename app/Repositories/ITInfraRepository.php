<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\CustomUser;
use App\Models\Email_InfoModel;
use App\Models\UsersInfoModel;
use App\Models\EmailCreationModel;
class ITInfraRepository implements IITInfraRepository {

public function get_candidate_email_info($data)
{
       $candidate_info=EmailCreationModel::join('customusers','customusers.cdID','=','candidate_email_request.cdID')
                       ->where('candidate_email_request.cdID',$data['cdID'])
                       ->select('customusers.username','customusers.email',
                                'customusers.doj','customusers.sup_name',
                                'customusers.sup_emp_code','customusers.contact_no',
                                'customusers.reviewer_emp_code','candidate_email_request.hr_suggested_mail',
                                'customusers.designation')
                       ->first();
       $info['supervisor_info']=UsersInfoModel::where('empID',$candidate_info['sup_emp_code'])->select('users.email')->first();
       $info['reviewer_info']=UsersInfoModel::where('empID',$candidate_info['reviewer_emp_code'])->select('users.email')->first();
       $info['email_info']=Email_InfoModel::where('header_id',5)->first();
       $info['candidate_info']=$candidate_info;
       return $info;
}

public function update_itInfra_EmailStatus($data)
{
           $result=EmailCreationModel::where('cdID',$data['cdID'])->update(['status'=>2,'hr_suggested_mail'=>$data['Email']]);
           return $result;
}
}

?>
