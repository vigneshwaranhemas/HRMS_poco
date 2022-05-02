<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\IAdminRepository;
use App\Repositories\IProfileRepositories;
use App\Repositories\ICommonRepositories;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use App\Image;
use Session;
use Validator;
class CommonController extends Controller
{
     public function id_card_varification(){
           return view('id_card_verification');
    } public function hr_id_card_verification(){
           return view('hr_id_card_verification');
    }   
    public function __construct(IAdminRepository $admrpy,IProfileRepositories $profrpy,ICommonRepositories $cmmrpy){
        $this->admrpy = $admrpy;
        $this->profrpy = $profrpy;
        $this->cmmrpy = $cmmrpy;
    }


    /*get iD card info*/
    public function idcard_info(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_ID = $session_val['empID'];
        if ($cdID !="") {
        $input_details = array( "cdID" => $cdID, );
        } else if( $emp_ID !=""){
        $input_details = array( "empID" => $emp_ID, );
        }
        $get_idcard_info_result = $this->profrpy->get_idcard_info( $input_details );
        
        return response()->json( $get_idcard_info_result );
        
    }

    /*ID_Card info save and update */
    public function idcard_info_save(Request $request){

        $validator=Validator::make($request->all(),[
                'f_name' => 'required',
                'l_name' => 'required',
                'emp_num_1' => 'required|numeric',
                'emrg_con_num' => 'required|numeric',
                'blood_grp' => 'required',
                'emrg_con_num' => 'required',
                'emp_dob' => 'required',
                ], [
                'f_name.required' => 'First Name is required',
                'l_name.required' => 'Last Name  is required',
                'emp_num_1.required' => 'Employee Mobile Number required',
                'emrg_con_num.required' => 'Emergency contact number is required',
                'blood_grp.required' => 'Blood Group is required',
                'emp_dob.required' => 'Date of birth is required',
                ]);
        if($validator->passes()){

            $session_val = Session::get('session_info');
            $emp_ID = $session_val['empID'];
            $cdID = $session_val['cdID'];

            $user = DB::table( 'customusers' )->where('cdID', '=', $cdID)->first();

        if ($user === null) {
                $data =array(
                    'emp_id'=>$emp_ID,
                    'cdID'=>$cdID,
                    'f_name'=>$request->input('f_name'),
                    'm_name'=>$request->input('m_name'),
                    'l_name'=>$request->input('l_name'),
                    'working_loc'=>$request->input('working_loc'),
                    'emp_num_1'=>$request->input('emp_num_1'),
                    'emp_num_2'=>$request->input('emp_num_2'),
                    'rel_emp'=>$request->input('rel_emp'),
                    'name_rel_ship'=>$request->input('name_rel_ship'),
                    'emrg_con_num'=>$request->input('emrg_con_num'),
                    'doj'=>$request->input('doj'),
                    'blood_grp'=>$request->input('blood_grp'),
                    'emp_code'=>$request->input('emp_code'),
                    'official_email'=>$request->input('official_email'),
                    'emp_dob'=>$request->input('emp_dob'),
                    // 'action'=>"0",
                    );

                $insert = DB::table( 'customusers' )->insert( $data );
                return response()->json(['response'=>'insert']);
            }else{
                $data =array(
                    // 'emp_id'=>$emp_ID,
                    'cdID'=>$cdID,
                    'f_name'=>$request->input('f_name'),
                    'm_name'=>$request->input('m_name'),
                    'l_name'=>$request->input('l_name'),
                    'working_loc'=>$request->input('working_loc'),
                    'emp_num_1'=>$request->input('emp_num_1'),
                    'emp_num_2'=>$request->input('emp_num_2'),
                    'rel_emp'=>$request->input('rel_emp'),
                    'name_rel_ship'=>$request->input('name_rel_ship'),
                    'emrg_con_num'=>$request->input('emrg_con_num'),
                    'doj'=>$request->input('doj'),
                    'blood_grp'=>$request->input('blood_grp'),
                    'empID'=>$emp_ID,
                    'official_email'=>$request->input('official_email'),
                    'emp_dob'=>$request->input('emp_dob'),
                    );
            $update_role_unit_details_result = $this->profrpy->update_idcard_info( $data );
                return response()->json(['response'=>'Update']);
            }
        }else{
            return response()->json(['error'=>$validator->errors()->toArray()]);
            }
        }

         /*HR ID_Card info Update */
    public function hr_idcard_verfi(Request $request){       

        $validator=Validator::make($request->all(),[
                // 'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'f_name' => 'required',
                'l_name' => 'required',
                'emp_num_1' => 'required|numeric',
                'emrg_con_num' => 'required|numeric',
                'blood_grp' => 'required',
                'emrg_con_num' => 'required',
                'emp_dob' => 'required',
                ], [
                'f_name.required' => 'First Name is required',
                'l_name.required' => 'Last Name  is required',
                'emp_num_1.required' => 'Employee Mobile Number required',
                'emrg_con_num.required' => 'Emergency contact number is required',
                'blood_grp.required' => 'Blood Group is required',
                'emp_dob.required' => 'Date of birth is required',
                ]);
         
        if($validator->passes()){

              $file = $request->file('file');
        if($file!=""){

            $destinationPath = public_path('ID_card_photo/'); 
           $profileImage = $request->input('emp_code') . "." ."jpg";
           // echo "<pre>";print_r($profileImage);die;
           $file->move($destinationPath, $profileImage);
           $path = "$profileImage";
           // $data ="";

                $data =array(
                    'img_path'=>$path,
                    // 'cdID'=>$cdID,
                    'can_id'=>$request->input('can_id'),
                    'f_name'=>$request->input('f_name'),
                    'm_name'=>$request->input('m_name'),
                    'l_name'=>$request->input('l_name'),
                    'working_loc'=>$request->input('working_loc'),
                    'emp_num_1'=>$request->input('emp_num_1'),
                    'emp_num_2'=>$request->input('emp_num_2'),
                    'rel_emp'=>$request->input('rel_emp'),
                    'name_rel_ship'=>$request->input('name_rel_ship'),
                    'emrg_con_num'=>$request->input('emrg_con_num'),
                    'doj'=>$request->input('doj'),
                    'blood_grp'=>$request->input('blood_grp'),
                    'empID'=>$request->input('emp_code'),
                    'official_email'=>$request->input('official_email'),
                    'emp_dob'=>$request->input('emp_dob'),
                    );
            }
            $update_role_unit_details_result = $this->cmmrpy->update_hr_idcard_info( $data );
                return response()->json(['response'=>'Update']);
        }else{
            return response()->json(['error'=>$validator->errors()->toArray()]);
            }
        }

    public function hr_get_id_card_vari(Request $request){

        $input_details = array( "id" => $request->id );
        $candidate_info_result_hr = $this->cmmrpy->get_candidate_info_hr( $input_details );
        
        return response()->json( $candidate_info_result_hr );
        
    }
}
