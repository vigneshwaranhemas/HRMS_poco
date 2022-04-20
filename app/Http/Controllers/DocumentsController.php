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

    public function store(Request $request)
    {
        
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
// echo "string";print_r($data);die;
        $insert = DB::table( 'documents' )->insert( $data );
    }
        return response()->json(['response'=>'insert']);

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
    /*account info */
    public function profile_account_add(Request $request){

      
            $validator=Validator::make($request->all(),[
                    'acc_name' => 'required',
                    'acc_number' => 'required|numeric',
                    'bank_name' => 'required',
                    'ifsc_code' => 'required',
                    'acc_mobile' => 'required|numeric',
                    'branch_name' => 'required',
                    ], [
                    'acc_name.required' => 'Account Name is required',
                    'acc_number.required' => 'Account Number is required',
                    'bank_name.required' => 'Bank Name is required',
                    'ifsc_code.required' => 'IFSC Code is required',
                    'acc_mobile.required' => 'Mobile Number is required',
                    'branch_name.required' => 'Branch Number is required',
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_ID = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                     $user = DB::table( 'candidate_account_information' )->where('cdID', '=', $cdID)->first();
                     // echo "<pre>";print_r($user);die;


        if ($user === null) {
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'acc_name'=>$request->input('acc_name'),
                        'acc_number'=>$request->input('acc_number'),
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
        $input_details = array( "cdID" => $cdID, );
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
        $education_result = $this->profrpy->Contact_info( $input_details );
        
        return response()->json( $education_result );
        
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
                        'p_adderss'=>$request->input('p_adderss'),
                        'c_address'=>$request->input('c_address'),
                        'p_email'=>$request->input('p_email'),
                        'State'=>$request->input('State'),
                        );

                    $insert = DB::table( 'candidate_contact_information' )->insert( $data );
                    return response()->json(['response'=>'insert']);
                }else{
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'phone_number'=>$request->input('phone_number'),
                        's_number'=>$request->input('s_number'),
                        'p_adderss'=>$request->input('p_adderss'),
                        'c_address'=>$request->input('c_address'),
                        'p_email'=>$request->input('p_email'),
                        'State'=>$request->input('State'),
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












}
