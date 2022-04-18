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
}
