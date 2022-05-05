<?php

namespace App\Http\Controllers;

use App\Repositories\IAdminRepository;
use App\Repositories\IProfileRepositories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Validator;

use Session;


class DocumentsController extends Controller
{

     public function __construct(IAdminRepository $admrpy,IProfileRepositories $profrpy)
    {
        $this->admrpy = $admrpy;
        $this->profrpy = $profrpy;
    }

    public function store(Request $request){
        
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $cdID = $session_val['cdID'];

        request()->validate([
        'documents_name' => 'required',
        'file' => 'required|mimes:doc,docx,pdf,txt|max:2048',
        ]);
        if ($files = $request->file('file')) {
        $destinationPath = public_path('uploads/'); 
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $path = "$profileImage";

            $data =array(
            'emp_id'=>$emp_ID,
            'cdID'=>$cdID,
            'doc_name'=>$request->input('documents_name'),
            'path'=>$path);
        $insert = DB::table( 'documents' )->insert( $data );
    }
        return response()->json(['response'=>'insert']);

    }
    /*banner image */
    public function profile_banner(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_id = $session_val['empID'];
        $input_details = array( "cdID" => $cdID,
                                "emp_id"=> $emp_id );
        $get_profile_info_result = $this->profrpy->get_banner_view( $input_details );
        // echo "123<pre>";print_r($get_profile_info_result);die;

        return response()->json( $get_profile_info_result );
    }

    /*PreviewImage */
    public function doc_information(Request $request){

        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $input_details = array( "emp_ID" => $emp_ID, );
        $get_documents_result = $this->admrpy->get_table('documents', $input_details );
        // echo "string";print_r($get_documents_result);die;
        return response()->json( $get_documents_result );  
    }
/*banner image*/
   public function imageCropPost(Request $request){


    /*$validator=Validator::make($request->all(),[
        'banner_image' => 'required',
        ], [
        'banner_image.required' => 'Baneer Image is required',
        ]);
        if($validator->passes()){*/

            $session_val = Session::get('session_info');
            $emp_ID = $session_val['empID'];
            $cdID = $session_val['cdID'];

            $user = DB::table( 'candidate_banner_image' )->where('cdID', '=', $cdID)->first();

             if ($user === null) {

                    $data = $request->image;
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name= 'Ban_'.time().'.png';
                    $path = public_path() . "/uploads/" . $image_name;
                    file_put_contents($path, $data);

                            $data =array(
                                'emp_id'=>$emp_ID,
                                'cdID'=>$cdID,
                                'banner_image'=>$image_name
                                );
                            // echo "<pre>";print_r($data);die;
                            $insert = DB::table( 'candidate_banner_image' )->insert( $data );
                            return response()->json(['response'=>'insert']);
                        }else{
                            $data = $request->image;
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name= 'Ban_'.time().'.png';
                    $path = public_path() . "/uploads/" . $image_name;
                    file_put_contents($path, $data);

                            $data =array(
                                'emp_id'=>$emp_ID,
                                'cdID'=>$cdID,
                                'banner_image'=>$image_name
                                );
                    // echo "<pre>";print_r($data);die;
                             $update_banner_image_result = $this->profrpy->update_banner_image( $data );
                                return response()->json(['response'=>'Update']);
                        }
                /*}else{
                    return response()->json(['error'=>$validator->errors()->toArray()]);
                    }*/
    }

    /*account info */
    public function profile_account_add(Request $request){

      
            $validator=Validator::make($request->all(),[
                    'acc_name' => 'required',
                    'acc_number' => 'required|numeric',
                    'con_acc_number' => 'required|numeric|same:acc_number',
                    'bank_name' => 'required',
                    'ifsc_code' => 'required',
                    'acc_mobile' => 'required|numeric',
                    'branch_name' => 'required',
                    ], [
                    'acc_name.required' => 'Account Name is required',
                    'acc_number.required' => 'Account Number is required',
                    'con_acc_number.required' => 'Account Number is required not match',
                    'bank_name.required' => 'Bank Name is required',
                    'ifsc_code.required' => 'IFSC Code is required',
                    'acc_mobile.required' => 'Mobile Number is required',
                    'branch_name.required' => 'Branch Name is required',
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_ID = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                     $user = DB::table( 'candidate_account_information' )->where('emp_id', '=', $emp_ID)->first();
                     // echo "<pre>";print_r($user);die;


        if ($user === null) {
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'acc_name'=>$request->input('acc_name'),
                        'acc_number'=>$request->input('acc_number'),
                        'con_acc_number'=>$request->input('con_acc_number'),
                        'bank_name'=>$request->input('bank_name'),
                        'ifsc_code'=>$request->input('ifsc_code'),
                        'acc_mobile'=>$request->input('acc_mobile'),
                        'branch_name'=>$request->input('branch_name'),
                        // 'type_id'=>$request->input('type_id'),
                        );

                    $insert = DB::table( 'candidate_account_information' )->insert( $data );
                    return response()->json(['response'=>'insert']);
                }else{
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'acc_name'=>$request->input('acc_name'),
                        'acc_number'=>$request->input('acc_number'),
                        'con_acc_number'=>$request->input('con_acc_number'),
                        'bank_name'=>$request->input('bank_name'),
                        'ifsc_code'=>$request->input('ifsc_code'),
                        'acc_mobile'=>$request->input('acc_mobile'),
                        'branch_name'=>$request->input('branch_name'),
                        );

                $update_role_unit_details_result = $this->profrpy->update_account_info( $data );
                    return response()->json(['response'=>'Update']);
                }
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }

        /*account info */
    public function account_info_get_res(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_ID = $session_val['empID'];
        $input_details = array( "cdID" => $cdID,
                                "emp_ID" => $emp_ID );
        $get_account_info_result = $this->profrpy->get_account_info( $input_details );
        
        return response()->json( $get_account_info_result );
        
    }

/*education_info_view*/
     public function education_info_view(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $input_details = array( "cdID" => $cdID, );
        $education_result = $this->profrpy->education_info( $input_details );
        
        return response()->json( $education_result );
        
    }
    /*account info */
    public function education_information_add(Request $request){

      
            $validator=Validator::make($request->all(),[
                    'qualification' => 'required',
                    'institute' => 'required',
                    'begin_on' => 'required',
                    'end_on' => 'required',
                    'edu_certificate' => 'required',
                    ], [
                    'qualification.required' => 'Qualification is required',
                    'institute.required' => 'Institute is required',
                    'begin_on.required' => 'Begin On is required',
                    'end_on.required' => 'End On is required',
                    'edu_certificate.required' => 'file is required',
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_ID = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                    $files = $request->file('edu_certificate');
                    $destinationPath = public_path('uploads/'); 
                   $profileImage ="edu_certificate". date('YmdHis') . "." . $files->getClientOriginalExtension();
                   $files->move($destinationPath, $profileImage);
                   $edu_certificate = "$profileImage";

                    // echo "<pre>";print_r($path);die;
                    $begin_on = explode('-', $request->input('begin_on'));
                    $edu_start_month = $begin_on[1];
                    $edu_start_year = $begin_on[0];
                    $end_on = explode('-', $request->input('end_on'));
                    $edu_end_month = $end_on[1];
                    $edu_end_year = $end_on[0];
                    $created_on = date("Y-m-d");
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'degree'=>$request->input('qualification'),
                        'university'=>$request->input('institute'),
                        'edu_start_month'=>$edu_start_month,
                        'edu_start_year'=>$edu_start_year,
                        'edu_end_month'=>$edu_end_month,
                        'edu_end_year'=>$edu_end_year,
                        'edu_certificate'=>$edu_certificate,
                        'created_on'=>$created_on,
                        );

                    $insert_education_info_result = $this->profrpy->insert_education_info( $data );
                    return response()->json(['response'=>'insert']);
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }

        /*experience info save */
    public function experience_information(Request $request){
        // echo "string";print_r("sadasda");die;

      
            $validator=Validator::make($request->all(),[
                    'job_title' => 'required',
                    'cmp_name' => 'required',
                    'exp_begin_on' => 'required',
                    'exp_end_on' => 'required',
                    ], [
                    'job_title.required' => 'Job Title is required',
                    'cmp_name.required' => 'Company Name is required',
                    'exp_begin_on.required' => 'Begin On is required',
                    'exp_end_on.required' => 'End On is required',
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_ID = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                    $files = $request->file('exp_file');
                    $destinationPath = public_path('uploads/'); 
                   $profileexp ="exp_file". date('YmdHis') . "." . $files->getClientOriginalExtension();
                   $files->move($destinationPath, $profileexp);
                   $exp_file = "$profileexp";

                    // echo "<pre>";print_r($exp_file);die;
                    $begin_on = explode('-', $request->input('exp_begin_on'));
                    $edu_start_month = $begin_on[1];
                    $edu_start_year = $begin_on[0];
                    $end_on = explode('-', $request->input('exp_end_on'));
                    $edu_end_month = $end_on[1];
                    $edu_end_year = $end_on[0];
                    // $created_on = date("Y-m-d");
                    $data =array(
                        'empID'=>$emp_ID,
                        'cdID'=>$cdID,
                        'job_title'=>$request->input('job_title'),
                        'company_name'=>$request->input('cmp_name'),
                        'exp_start_month'=>$edu_start_month,
                        'exp_start_year'=>$edu_start_year,
                        'exp_end_month'=>$edu_end_month,
                        'exp_end_year'=>$edu_end_year,
                        'certificate'=>$exp_file,
                        // 'created_on'=>$created_on,
                        );
                // echo "<pre>";print_r($data);die;
                    $insert_education_info_result = $this->profrpy->insert_experience_info( $data );
                    return response()->json(['response'=>'insert']);
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }
        /*experience_info_result*/
    public function experience_info_result(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $input_details = array( "cdID" => $cdID, );
        $education_result = $this->profrpy->experience_info( $input_details );
        
        return response()->json( $education_result );
        
    }
    public function Contact_info_view(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $input_details = array( "cdID" => $cdID, );
        $Contact_info_result = $this->profrpy->Contact_info( $input_details );
        // echo "<pre>";print_r($education_result);die;
        return response()->json( $Contact_info_result );
        
    }

    /*contact info */
    public function add_contact_info(Request $request){

      
            $validator=Validator::make($request->all(),[
                    'phone_number' => 'required|numeric',
                    
                    ], [
                    'phone_number.required' => 'Phone Number is required',
                    
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_ID = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                     $user = DB::table( 'candidate_contact_information' )->where('cdID', '=', $cdID)->first();
                     // echo "<pre>";print_r($user);die;

            if ($user === null) {
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'phone_number'=>$request->input('phone_number'),
                        's_number'=>$request->input('s_number'),
                        'p_addres'=>$request->input('p_addres'),
                        'p_town'=>$request->input('p_town'),
                        'p_State'=>$request->input('p_State'),
                        'p_district'=>$request->input('p_district'),
                        'c_addres'=>$request->input('c_addres'),
                        'c_town'=>$request->input('c_town'),
                        'c_State'=>$request->input('c_State'),
                        'c_district'=>$request->input('c_district'),
                        'p_email'=>$request->input('p_email'),
                        // 'State'=>$request->input('State'),
                        );

                    $insert = DB::table( 'candidate_contact_information' )->insert( $data );
                    return response()->json(['response'=>'insert']);
                }else{
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'phone_number'=>$request->input('phone_number'),
                        's_number'=>$request->input('s_number'),
                        'p_addres'=>$request->input('p_addres'),
                        'p_town'=>$request->input('p_town'),
                        'p_State'=>$request->input('p_State'),
                        'p_district'=>$request->input('p_district'),
                        'c_addres'=>$request->input('c_addres'),
                        'c_town'=>$request->input('c_town'),
                        'c_State'=>$request->input('c_State'),
                        'c_district'=>$request->input('c_district'),
                        'p_email'=>$request->input('p_email'),
                        // 'State'=>$request->input('State'),
                        );
                $update_role_unit_details_result = $this->profrpy->update_contact( $data );
                    return response()->json(['response'=>'Update']);
                }
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }

/*family info */
     public function family_information_view(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $input_details = array( "cdID" => $cdID, );
        $education_result = $this->profrpy->family_info( $input_details );
        
        return response()->json( $education_result );
        
    }

    public function add_family_add(Request $request){      
            $validator=Validator::make($request->all(),[
                    'fm_name' => 'required',
                    'fm_gender' => 'required',
                    'fn_relationship' => 'required',
                    'fn_marital' => 'required',
                    'fn_blood_gr' => 'required',
                    
                    ], [
                    'fm_name.required' => 'Name is required',
                    'fm_gender.required' => 'Gender is required',
                    'fn_relationship.required' => 'Relationship is required',
                    'fn_marital.required' => 'Marital Status is required',
                    'fn_blood_gr.required' => 'Blood Group is required',
                    
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_ID = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'fm_name'=>$request->input('fm_name'),
                        'fm_gender'=>$request->input('fm_gender'),
                        'fn_relationship'=>$request->input('fn_relationship'),
                        'fn_marital'=>$request->input('fn_marital'),
                        'fn_blood_gr'=>$request->input('fn_blood_gr'),
                        );
                    $insert = DB::table( 'candidate_family_information' )->insert( $data );
                    return response()->json(['response'=>'insert']);
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }

/*state Get*/
     public function state_get(Request $request){
        // $input_details['town_name']  =  $request->input('town_name');
        $education_result = $this->profrpy->state_listing();
        return response()->json( $education_result );
        
    }
    /*district Get*/
     public function get_district(Request $request){
        $input_details['state_name']  =  $request->input('p_State');
        $district_result = $this->profrpy->get_district_listing($input_details);
        
        return response()->json( $district_result );
        
    }
    /*district  curr Get*/
     public function get_district_cur(Request $request){
        $input_details['state_name']  =  $request->input('c_State');
        $district_result = $this->profrpy->get_district_listing($input_details);
        
        return response()->json( $district_result );
        
    }
    /*town Get*/
     public function get_town_name(Request $request){
        $input_details['district_name']  =  $request->input('p_district');
        // echo "<pre>";print_r($input_details);die;
        $district_result = $this->profrpy->get_town_name_listing( $input_details);
        
        return response()->json( $district_result );
        
    }
    /*town curr Get*/
     public function get_town_name_curr(Request $request){
        $input_details['district_name']  =  $request->input('c_district');
        $district_result = $this->profrpy->get_town_name_listing( $input_details);
        
        return response()->json( $district_result );
        
    }








}
