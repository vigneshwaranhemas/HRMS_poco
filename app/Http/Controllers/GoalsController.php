<?php

namespace App\Http\Controllers;

use App\Repositories\IGoalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Goals;
use Auth;
use Session;
use Mail;
use App\Models\CustomUser;

class GoalsController extends Controller
{
    public function __construct(IGoalRepository $goal)
    {
        $this->middleware('is_admin');
        $this->goal = $goal;
    }
    public function goal_setting_bh_reviewer_view()
    {
        $id=$_GET['id'];
        $data=$this->goal->Fetch_goals_user_info($id);
        // return view('goals.goal_setting_reviewer_view')->with('user_info',$data);
        return view('goals.goal_setting_bh_reviewer_view')->with('user_info',$data);
    }
    public function goals()
    {
        $result = $this->goal->checkCustomUserList();
        $team_member_list = $this->goal->fetchSupervisorList();
        $supervisor_list = $this->goal->fetchSupervisorList();
        $reviewer_list = $this->goal->fetchReviewerList();
        $logined_empID = Auth::user()->empID;
        if($logined_empID == "900531"){ //business head
            return view('goals.bh_goal_index')->with("reviewer_list", $reviewer_list);
        }elseif($logined_empID == "900380"){ //HR head
            return view('goals.hr_goal_index')->with("reviewer_list", $reviewer_list);
        }elseif($result == "Reviewer"){
            return view('goals.reviewer_goal_index')->with("supervisor_list", $supervisor_list);
        }elseif($result == "Supervisor"){
            return view('goals.sup_goal_index')->with("team_member_list", $team_member_list);
        }else{
            return view('goals.index');
        }

    }
    public function calendar()
    {
        return view('birthday.sample');
    }
    public function add_goal_setting()
    {
        return view('goals.add_goal_setting');
    }
    public function goal_setting()
    {
        return view('goals.goal_setting');
    }
    public function goal_setting_supervisor_edit()
    {
        return view('goals.goal_setting_supervisor_edit');
    }
    public function goal_setting_edit()
    {
        return view('goals.edit_goal');
    }
    public function goal_setting_reviewer_edit()
    {
        return view('goals.goal_setting_reviewer_edit');
    }
    public function goal_setting_bh_edit()
    {
        return view('goals.goal_setting_bh_edit');
    }
    public function goal_setting_supervisor_view()
    {
        $customusers = $this->goal->fetchCustomUserList();
        return view('goals.goal_setting_supervisor_view')->with('customusers', $customusers);
    }
    public function goal_setting_reviewer_view()
    {
        $id=$_GET['id'];
        $data=$this->goal->Fetch_goals_user_info($id);
        return view('goals.goal_setting_reviewer_view')->with('user_info',$data);
    }
    public function goal_setting_hr_view()
    {
        return view('goals.goal_setting_hr_view');
    }
    public function edit_goal()
    {
        return view('goals.edit_goal');
    }
    public function goals_sheet_head(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->fetchGoalIdHead($id);
        return json_encode($head);
    }
    public function goals_consolidate_rate_head(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->goals_consolidate_rate_head($id);
        return json_encode($head);
    }
    public function goals_sup_submit_status(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->goals_sup_submit_status($id);
        return json_encode($head);
    }
    public function goals_sup_consolidate_rate_head(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->goals_sup_consolidate_rate_head($id);
        return json_encode($head);
    }
    public function update_goals_sup_submit_direct(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->update_goals_sup_submit_direct($id);
        return json_encode($head);
    }
    public function goals_sup_th_check(Request $request)
    {
        $id = $request->id;
        $result = $this->goal->checkSupervisorIDOrNot($id);
        if(!empty($result)){
            $head = "Yes";
        }else{
            $head = "No";
        }
        return json_encode($head);
    }
    public function get_supervisor(){

        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $result = $this->goal->get_supervisor_data($emp_ID);
        // echo "11<pre>";print_r($result);die;
        return json_encode($result);
    }
    public function fetch_reviewer_res(Request $request){

        $emp_ID =  $request->input('reviewer_filter');
        // echo "11<pre>";print_r($request->input('reviewer_filter'));die;
        $result = $this->goal->fetch_reviewer_res_data($emp_ID);
        return json_encode($result);
    }
    public function get_reviewer_list(Request $request){

        if ($request !="") {
            $input_details = array(
                'supervisor_list_1'=>$request->input('supervisor_list_1'),
                'team_member_filter'=>$request->input('team_member_filter'),
            );
        }
        // echo "11<pre>";print_r($input_details);die;
        $result = $this->goal->fetch_reviewer_tab_data($input_details);


        return DataTables::of($result)
        ->addIndexColumn()
        ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
        ->addColumn('action', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending" || $row->goal_status == "Revert"){


                        $btn = '<div class="dropup">
                                <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                                </div>' ;


                }elseif($row->goal_status == "Approved"){

                    $id = $row->goal_unique_code;
                    $result = $this->goal->check_goals_employee_summary($id);

                    if($result == "Yes"){
                        $btn = '<div class="dropup">
                                <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                                </div>' ;
                    }else{
                        $btn = '<div class="dropup">
                                <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                                </div>' ;
                    }

                }
            return $btn;
        })

        ->rawColumns(['action','status'])
        ->make(true);

    }
    public function fetch_goals_setting_id_details(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;

            $html .= '<tr  class="border-bottom-primary">';
            /*cell 1*/
            $html .= '<th scope="row">'.$cell1.'</th>';

            /*cell 2*/
            if($row_values->$cell2 != null){
                $html .= '<td>';

                    foreach($row_values->$cell2 as $cell2_value){
                        // dd($cell3_value);
                        if($cell2_value != null){

                            $html .= '<p>'.$cell2_value.'</p>';

                        }else{
                            $html .= '<p></p>';

                        }
                    }

                    $html .= '</td>';
            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 3*/
            if($row_values->$cell3 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell3 as $cell3_value){
                        // dd($cell3_value);
                        if($cell3_value != null){

                            $html .= '<p>'.$cell3_value.'</p>';

                        }else{
                            $html .= '<p></p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 4*/
            if($row_values->$cell4 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell4 as $cell4_value){
                        // dd($cell3_value);
                        if($cell4_value != null){

                            $html .= '<p>'.$cell4_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 5*/
            if($row_values->$cell5 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell5 as $cell5_value){
                        // dd($cell3_value);
                        if($cell5_value != null){

                            $html .= '<p>'.$cell5_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 6*/
            if($row_values->$cell6 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell6 as $cell6_value){
                        // dd($cell3_value);
                        if($cell6_value != null){

                            $html .= '<p>'.$cell6_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 7*/
            // if($row_values->$cell7 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell7 as $cell7_value){
            //             // dd($cell3_value);
            //             if($cell7_value != null){

            //                 $html .= '<p>'.$cell7_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';

            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            // /*cell 8*/
            // if($row_values->$cell8 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell8 as $cell8_value){
            //             // dd($cell3_value);
            //             if($cell8_value != null){

            //                 $html .= '<p>'.$cell8_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';

            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            /*cell 9*/
            // if($row_values->$cell9 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell9 as $cell9_value){
            //             // dd($cell3_value);
            //             if($cell9_value != null){

            //                 $html .= '<p>'.$cell9_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';

            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            // /*cell 10*/
            // if($row_values->$cell10 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell10 as $cell10_value){
            //             // dd($cell3_value);
            //             if($cell10_value != null){

            //                 $html .= '<p>'.$cell10_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';

            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            //  /*cell 11*/
            //  if($row_values->$cell11 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell11 as $cell11_value){
            //             // dd($cell3_value);
            //             if($cell11_value != null){

            //                 $html .= '<p>'.$cell11_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';

            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            // /*cell 12*/
            // if($row_values->$cell12 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell12 as $cell12_value){
            //             // dd($cell3_value);
            //             if($cell12_value != null){

            //                 $html .= '<p>'.$cell12_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';


            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            //  /*cell 13*/
            //  if($row_values->$cell13 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';

            //         foreach($row_values->$cell13 as $cell13_value){
            //             // dd($cell3_value);
            //             if($cell13_value != null){

            //                 $html .= '<p>'.$cell13_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';

            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }


            $html .= '</tr>';

        }

        // dd($html);

        return json_encode($html);
    }
    public function fetch_goals_sup_details(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell10 = "hr_remarks_".$cell1;
            $cell11 = "bh_sign_off_".$cell1;

            $html .= '<tr  class="border-bottom-primary">';
            /*cell 1*/
            $html .= '<th scope="row">'.$cell1.'</th>';

            /*cell 2*/
            if($row_values->$cell2 != null){
                $html .= '<td>';

                    foreach($row_values->$cell2 as $cell2_value){
                        if($cell2_value != null){

                            $html .= '<p>'.$cell2_value.'</p>';

                        }else{
                            $html .= '<p></p>';

                        }
                    }

                    $html .= '</td>';
            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 3*/
            if($row_values->$cell3 != null){
                $html .= '<td>';
                    foreach($row_values->$cell3 as $cell3_value){
                        if($cell3_value != null){

                            $html .= '<p>'.$cell3_value.'</p>';

                        }else{
                            $html .= '<p></p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 4*/
            if($row_values->$cell4 != null){
                $html .= '<td>';
                    foreach($row_values->$cell4 as $cell4_value){
                        if($cell4_value != null){
                            $html .= '<p>'.$cell4_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 5*/
            if($row_values->$cell5 != null){
                $html .= '<td>';
                    foreach($row_values->$cell5 as $cell5_value){
                        if($cell5_value != null){
                            $html .= '<p>'.$cell5_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 6*/
            if($row_values->$cell6 != null){
                $html .= '<td>';
                    foreach($row_values->$cell6 as $cell6_value){
                        if($cell6_value != null){
                            $html .= '<p>'.$cell6_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 7*/
            if($row_values->$cell7 != null){
                $html .= '<td class="sup_remark">';

                    foreach($row_values->$cell7 as $cell7_value){
                        if($cell7_value != null){

                            $html .= '<p class="sup_remark_p_'.$cell1.'">'.$cell7_value.'</p>';

                        }
                    }
                $html .= '</td>';

            }else{
                $html .= '<td class="sup_remark">';
                $html .= '</td>';
            }

            /*cell 8*/
            if($row_values->$cell8 != null){
                $html .= '<td class="sup_rating">';
                    foreach($row_values->$cell8 as $cell8_value){
                        if($cell8_value != null){
                            $html .= '<p class="sup_rating_p_'.$cell1.'">'.$cell8_value.'</p>';
                        }
                    }
                $html .= '</td>';

            }else{
                $html .= '<td class="sup_rating">';
                $html .= '</td>';
            }


            /*cell 9*/
            if($row_values->$cell9 != null){
                $html .= '<td>';
                    foreach($row_values->$cell9 as $cell9_value){
                        if($cell9_value != null){
                            $html .= '<p>'.$cell9_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 10*/
            if($row_values->$cell10 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell10 as $cell10_value){
                        // dd($cell3_value);
                        if($cell10_value != null){

                            $html .= '<p>'.$cell10_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

             /*cell 11*/
             if($row_values->$cell11 != null){
                $html .= '<td>';
                    foreach($row_values->$cell11 as $cell11_value){
                        if($cell11_value != null){
                            $html .= '<p>'.$cell11_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 12*/
            // if($row_values->$cell12 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell12 as $cell12_value){
            //             // dd($cell3_value);
            //             if($cell12_value != null){

            //                 $html .= '<p>'.$cell12_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';


            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            // /*cell 13*/
            // if($row_values->$cell13 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';

            //         foreach($row_values->$cell13 as $cell13_value){
            //             // dd($cell3_value);
            //             if($cell13_value != null){

            //                 $html .= '<p>'.$cell13_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';

            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            //  /*cell 13*/
            //  if($row_values->$cell14 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell14 as $cell14_value){
            //             // dd($cell3_value);
            //             if($cell14_value != null){

            //                 $html .= '<p>'.$cell14_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';


            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }


            $html .= '</tr>';

        }

        // dd($html);

        return json_encode($html);
    }
    public function fetch_goals_hr_details(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell10 = "hr_remarks_".$cell1;
            $cell11 = "bh_sign_off_".$cell1;

            $html .= '<tr  class="border-bottom-primary">';
            /*cell 1*/
            $html .= '<th scope="row">'.$cell1.'</th>';
            // echo "5<pre>";print_r($row_values->$cell5);
            // echo "6<pre>";print_r($row_values->$cell6);
            // echo "7<pre>";print_r($row_values->$cell7);
            // echo "8<pre>";print_r($row_values->$cell8);
            // echo "9<pre>";print_r($row_values->$cell9);
            // echo "10<pre>";print_r($row_values->$cell10);
            // echo "11<pre>";print_r($row_values->$cell11);
            // die;
            /*cell 2*/
            if($row_values->$cell2 != null){
                $html .= '<td>';

                    foreach($row_values->$cell2 as $cell2_value){
                        if($cell2_value != null){

                            $html .= '<p>'.$cell2_value.'</p>';

                        }else{
                            $html .= '<p></p>';

                        }
                    }

                    $html .= '</td>';
            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 3*/
            if($row_values->$cell3 != null){
                $html .= '<td>';
                    foreach($row_values->$cell3 as $cell3_value){
                        if($cell3_value != null){

                            $html .= '<p>'.$cell3_value.'</p>';

                        }else{
                            $html .= '<p></p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 4*/
            if($row_values->$cell4 != null){
                $html .= '<td>';
                    foreach($row_values->$cell4 as $cell4_value){
                        if($cell4_value != null){
                            $html .= '<p>'.$cell4_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 5*/
            if($row_values->$cell5 != null){
                $html .= '<td>';
                    foreach($row_values->$cell5 as $cell5_value){
                        if($cell5_value != null){
                            $html .= '<p>'.$cell5_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 6*/
            if($row_values->$cell6 != null){
                $html .= '<td>';
                    foreach($row_values->$cell6 as $cell6_value){
                        if($cell6_value != null){
                            $html .= '<p>'.$cell6_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 7*/
            if($row_values->$cell7 != null){
                $html .= '<td class="sup_remark">';

                    foreach($row_values->$cell7 as $cell7_value){
                        if($cell7_value != null){

                            $html .= '<p class="super_p'.$cell1.'">'.$cell7_value.'</p>';

                        }
                    }
                $html .= '</td>';

            }else{
                $html .= '<td class="sup_remark">';
                $html .= '</td>';
            }

            /*cell 8*/
            if($row_values->$cell8 != null){
                $html .= '<td class="sup_rating">';
                    foreach($row_values->$cell8 as $cell8_value){
                        if($cell8_value != null){
                            $html .= '<p class="sup_rating'.$cell1.'">'.$cell8_value.'</p>';
                        }
                    }
                $html .= '</td>';

            }else{
                $html .= '<td class="sup_rating">';
                $html .= '</td>';
            }


            /*cell 9*/
            if($row_values->$cell9 != null){
                // echo  json_encode($row_values->$cell9);
                $html .= '<td class="reviewer_remarks">';
                    foreach($row_values->$cell9 as $cell9_value){
                        if($cell9_value != null){
                            $html .= '<p class="reviewer_p'.$cell1.'">'.$cell9_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td class="reviewer_remarks">';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 10*/
            if($row_values->$cell10 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td class="hr_remarks">';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell10 as $cell10_value){
                        // dd($cell3_value);
                        if($cell10_value != null){

                            $html .= '<p class="hr_remark_p'.$cell1.'">'.$cell10_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td class="hr_remarks">';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

             /*cell 11*/
             if($row_values->$cell11 != null){
                $html .= '<td>';
                    foreach($row_values->$cell11 as $cell11_value){
                        if($cell11_value != null){
                            $html .= '<p>'.$cell11_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                $html .= '</td>';
            }

            /*cell 12*/
            // if($row_values->$cell12 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell12 as $cell12_value){
            //             // dd($cell3_value);
            //             if($cell12_value != null){

            //                 $html .= '<p>'.$cell12_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';


            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            // /*cell 13*/
            // if($row_values->$cell13 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';

            //         foreach($row_values->$cell13 as $cell13_value){
            //             // dd($cell3_value);
            //             if($cell13_value != null){

            //                 $html .= '<p>'.$cell13_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';

            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }

            //  /*cell 13*/
            //  if($row_values->$cell14 != null){
            //     //    dd(count($row_values->$cell3));
            //     $html .= '<td>';
            //         // $html .= '<p>HR Shared Services : </p>';


            //         foreach($row_values->$cell14 as $cell14_value){
            //             // dd($cell3_value);
            //             if($cell14_value != null){

            //                 $html .= '<p>'.$cell14_value.'</p>';


            //             }
            //         }

            //     $html .= '</td>';


            // }else{
            //     $html .= '<td>';
            //     // $html .= '<p></p>';
            //     $html .= '</td>';
            // }


            $html .= '</tr>';

        }

        // dd($html);

        return json_encode($html);
    }
    public function fetch_goals_reviewer_details(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $reviewer = $this->goal->checkReviewerIDOrNot($id);
        $get_sheet_status=Goals::where('goal_unique_code',$id)
                                 ->select('goal_status',
                                        'supervisor_consolidated_rate',
                                        'bh_status','employee_consolidated_rate',
                                        'supervisor_consolidated_rate',
                                        'bh_tb_status','goal_status')->first();
        $datas = json_decode($json);
        $html = '';
        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            // echo json_encode($row_values);die();
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell10 = "hr_remarks_".$cell1;
            $cell11 = "bh_sign_off_".$cell1;
            $html .= '<tr  class="border-bottom-primary">';



                /*Cell 1*/
                $html .= '<th scope="row">'.$cell1.'</th>';

                /*Cell 2*/

                if($row_values->$cell2 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell2 as $cell2_value){
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td  class="one">';
                    $html .= '</td>';
                }

                /*Cell 3*/
                $count=0;
                if($row_values->$cell3 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell3 as $cell3_value){
                            // dd($cell3_value);
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                            $count++;
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td  class="two">';
                    $html .= '</td>';
                }

                // echo json_encode($count);die();

                /*Cell 4*/
                if($row_values->$cell4 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td  class="three">';
                    $html .= '</td>';
                }

                 /*Cell 5*/
                if($row_values->$cell5 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td  class="four">';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }
                  /*Cell 6*/
                  if($row_values->$cell6 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td  class="fice">';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 7*/
                $html .= '<td class="supervisor_remarks">';
                if($row_values->$cell7 != null){
                $html .= '<p>'.$row_values->$cell7[0].'</p>';
                }
                $html .= '</td>';
            /*cell 7*/
            // if($row_values->$cell7 != null){
            //     $html .= '<td>';
            //         foreach($row_values->$cell7 as $cell7_value){
            //             if($cell7_value != null){

            //                 $html .= '<p>'.$cell7_value.'</p>';

            //             }
            //         }

            //     $html .= '</td>';

            //     /*Cell 15*/
            //     $html .= '<td  class="six">';
            //     $html .= '</td>';
            // }

            /*cell 8*/
            if($row_values->$cell8 != null){
                $html .= '<td class="supervisor_rating">';
                    foreach($row_values->$cell8 as $cell8_value){
                        if($cell8_value != null){
                            $html .= '<p class="supervisor_p_'.$cell1.'">'.$cell8_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td class="supervisor_rating">';
                $html .= '</td>';
            }

            /*cell 9*/
            if($row_values->$cell9 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td class="reviewer_remarks">';
                    foreach($row_values->$cell9 as $cell9_value){
                        if($cell9_value != null){

                            $html .= '<p>'.$cell9_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td class="reviewer_remarks">';
                $html .= '</td>';
            }

            /*cell 10*/
            if($row_values->$cell10 != null){
                $html .= '<td>';
                    foreach($row_values->$cell10 as $cell10_value){
                        if($cell10_value != null){

                            $html .= '<p>'.$cell10_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td class="seven">';
                $html .= '</td>';
            }

            /*cell 11*/



            if($row_values->$cell11 != null){
                $html .= '<td class="business_head">';
                    foreach($row_values->$cell11 as $cell11_value){
                        // dd($cell3_value);
                        if($cell11_value != null){
                            $html .= '<p class="removable_p_'.$cell1.'">'.$cell11_value.'</p>';
                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td class="business_head ">';
                $html .= '</td>';
            }

            $html .= '</tr>';

        }
        // dd($html);
        // return json_encode($html);

        $new_data['html']=$html;
        $new_data['reviewer']=$reviewer;
        $new_data['get_sheet_status']=$get_sheet_status;
        $new_data['count']=$count;
        // $new_data['hidden_rows']=$hidden_rows;

    return response()->json($new_data);
    }

    public function fetch_goals_supervisor_edit(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            // dd($cell2);

            $html .= '<tr  class="border-bottom-primary">';

            /*Cell 1*/
            $html .= '<th scope="row">'.$cell1.'</th>';

            /*Cell 2*/
            if($row_values->$cell2 != null){
                $html .= '<td>';

                    foreach($row_values->$cell2 as $cell2_value){
                        // dd($cell3_value);
                        if($cell2_value != null){

                            $html .= '<p>'.$cell2_value.'</p>';

                        }else{
                            $html .= '<p></p>';

                        }
                    }

                    $html .= '</td>';
            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*Cell 3*/
            if($row_values->$cell3 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell3 as $cell3_value){
                        // dd($cell3_value);
                        if($cell3_value != null){

                            $html .= '<p>'.$cell3_value.'</p>';

                        }else{
                            $html .= '<p></p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*Cell 4*/
            if($row_values->$cell4 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell4 as $cell4_value){
                        // dd($cell3_value);
                        if($cell4_value != null){

                            $html .= '<p>'.$cell4_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*Cell 5*/
            if($row_values->$cell5 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell5 as $cell5_value){
                        // dd($cell3_value);
                        if($cell5_value != null){

                            $html .= '<p>'.$cell5_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*Cell 6*/
            if($row_values->$cell6 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell6 as $cell6_value){
                        // dd($cell3_value);
                        if($cell6_value != null){

                            $html .= '<p>'.$cell6_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

             /*Cell 7*/
             $html .= '<td>';
             if($row_values->$cell7 != null){
                 $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell7[0].'</textarea>';
             }else{
                 $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control"></textarea>';
             }
             $html .= '</td>';

            /*Cell 8*/
            $html .= '<td>';
                $html .= '<option value="" selected>...Select...</option>';
                if($row_values->$cell8 != null){
                    $html .= '<input type="text" name="sup_rating_'.$cell1.'[]" value="'.$row_values->$cell8[0].'" class="form-control">';
                    $html .= '<option value="EE">EE - Exceeded Expectations</option>';
                    $html .= '<option value="AE - Achieved Expectations">AE - Achieved Expectations</option>';
                    $html .= '<option value="ME - Met Expectations">ME - Met Expectations</option>';
                    $html .= '<option value="PE - Partially Met Expectations">PE - Partially Met Expectations</option>';
                    $html .= '<option value="ND - Needs Development">ND - Needs Development</option>';
                }else{
                    $html .= '<input type="text" name="sup_rating_'.$cell1.'[]" class="form-control">';
                }
            $html .= '</td>';



            $html .= '</tr>';

        }

        // echo "<pre>";print_r($html);die;

        return json_encode($html);
    }
    public function fetch_goals_reviewer_edit(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $supvisor = $this->goal->checkSupervisorIDOrNot($id);
        if(!empty($supvisor)){
            //supervisor reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;
                $cell10 = "hr_remarks_".$cell1;
                $cell11 = "bh_sign_off_".$cell1;

                $html .= '<tr  class="border-bottom-primary">';

                /*Cell 1*/
                $html .= '<th scope="row">'.$cell1.'</th>';

                /*Cell 2*/
                if($row_values->$cell2 != null){
                    $html .= '<td>';

                        foreach($row_values->$cell2 as $cell2_value){
                            // dd($cell3_value);
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 3*/
                if($row_values->$cell3 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell3 as $cell3_value){
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*Cell 4*/
                if($row_values->$cell4 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 5*/
                if($row_values->$cell5 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 6*/
                if($row_values->$cell6 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 7*/
                $html .= '<td>';
                if($row_values->$cell7 != null){
                    $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control">'.$row_values->$cell7[0].'</textarea>';
                }else{
                    $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control"></textarea>';
                }
                $html .= '</td>';

                /*Cell 8*/
                 $html .= '<td>';
                if($row_values->$cell8 != null){
                    $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control">'.$row_values->$cell8[0].'</textarea>';
                }else{
                    $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control"></textarea>';
                }
                $html .= '</td>';



                $html .= '</tr>';

            }

        }else{
            //employee reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;

                $html .= '<tr  class="border-bottom-primary">';

                /*Cell 1*/
                $html .= '<th scope="row">'.$cell1.'</th>';

                /*Cell 2*/
                if($row_values->$cell2 != null){
                    $html .= '<td>';

                        foreach($row_values->$cell2 as $cell2_value){
                            // dd($cell3_value);
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 3*/
                if($row_values->$cell3 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell3 as $cell3_value){
                            // dd($cell3_value);
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 4*/
                if($row_values->$cell4 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 5*/
                if($row_values->$cell5 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 6*/
                if($row_values->$cell6 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 7*/
                $html .= '<td>';
                if($row_values->$cell7 != null){
                $html .= '<p>'.$row_values->$cell7[0].'</p>';
                }
                $html .= '</td>';

                /*Cell 8*/
                $html .= '<td>';
                if($row_values->$cell8 != null){
                    $html .= '<p>'.$row_values->$cell8[0].'</p>';
                }
                $html .= '</td>';

                /*Cell 9*/
                $html .= '<td>';
                if($row_values->$cell9 != null){
                     $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell9[0].'</textarea>';
                 }else{
                     $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                 }
                $html .= '</td>';


                $html .= '</td>';

                $html .= '</tr>';

            }

        }


        // dd($html);

        return json_encode($html);
    }
    public function fetch_goals_hr_edit(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $supvisor = $this->goal->checkSupervisorIDOrNot($id);

        //employee reviewer edit concept

        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell10 = "hr_remarks_".$cell1;

            $html .= '<tr  class="border-bottom-primary">';

                /*Cell 1*/
                $html .= '<th scope="row">'.$cell1.'</th>';

                /*Cell 2*/
                if($row_values->$cell2 != null){
                    $html .= '<td>';

                        foreach($row_values->$cell2 as $cell2_value){
                            // dd($cell3_value);
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 3*/
                if($row_values->$cell3 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell3 as $cell3_value){
                            // dd($cell3_value);
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 4*/
                if($row_values->$cell4 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 5*/
                if($row_values->$cell5 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 6*/
                if($row_values->$cell6 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 7*/
                $html .= '<td>';
                if($row_values->$cell7 != null){
                $html .= '<p>'.$row_values->$cell7[0].'</p>';
                }
                $html .= '</td>';

                /*Cell 8*/
                $html .= '<td>';
                if($row_values->$cell8 != null){
                    $html .= '<p>'.$row_values->$cell8[0].'</p>';
                }
                $html .= '</td>';

                /*Cell 9*/
                $html .= '<td>';
                if($row_values->$cell9 != null){
                    $html .= '<p>'.$row_values->$cell9[0].'</p>';
                }
                $html .= '</td>';


                /*Cell 10*/
                $html .= '<td>';
                if($row_values->$cell10 != null){
                        $html .= '<textarea type="text" name="hr_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell10[0].'</textarea>';
                    }else{
                        $html .= '<textarea type="text" name="hr_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                    }
                $html .= '</td>';

                $html .= '</td>';

            $html .= '</tr>';

        }


        // dd($html);

        return json_encode($html);
    }
    public function fetch_goals_bh_edit(Request $request)
    {
        $id = $request->id;
        $reviewer = $this->goal->checkReviewerIDOrNot($id);
        // echo json_encode($reviewer);die();


        if($reviewer==1){


            //supervisor reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;
                // $cell10 =  "hr_remarks_".$cell1;
                $cell11 = "bh_sign_off_".$cell1;


                // echo json_encode($cell7);die();

                $html .= '<tr  class="border-bottom-primary">';

                    /*Cell 1*/
                    $html .= '<th scope="row">'.$cell1.'</th>';

                    /*Cell 2*/
                    if($row_values->$cell2 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell2 as $cell2_value){
                                if($cell2_value != null){

                                    $html .= '<p>'.$cell2_value.'</p>';

                                }else{
                                    $html .= '<p></p>';

                                }
                            }

                            $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*Cell 3*/
                    if($row_values->$cell3 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell3 as $cell3_value){
                                // dd($cell3_value);
                                if($cell3_value != null){

                                    $html .= '<p>'.$cell3_value.'</p>';

                                }else{
                                    $html .= '<p></p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*Cell 4*/
                    if($row_values->$cell4 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell4 as $cell4_value){
                                // dd($cell3_value);
                                if($cell4_value != null){

                                    $html .= '<p>'.$cell4_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*Cell 5*/
                    if($row_values->$cell5 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell5 as $cell5_value){
                                // dd($cell3_value);
                                if($cell5_value != null){

                                    $html .= '<p>'.$cell5_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        // $html .= '<p></p>';
                        $html .= '</td>';
                    }

                    /*Cell 6*/
                    if($row_values->$cell6 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell6 as $cell6_value){
                                // dd($cell3_value);
                                if($cell6_value != null){

                                    $html .= '<p>'.$cell6_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        // $html .= '<p></p>';
                        $html .= '</td>';
                    }
                    // die();

                    /*Cell 7*/
                    $html .= '<td>';
                       if($row_values->$cell7 != null){
                            // echo json_encode("one");die();
                        $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell7[0].'</textarea>';
                        }else{
                            $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                        }
                       $html .= '</td>';

                       /*Cell 8*/
                       $html .= '<td>';
                       if($row_values->$cell8 != null){
                        $html .= '<textarea type="text" name="sup_final_output_'.$cell1.'[]" class="form-control">'.$row_values->$cell8[0].'</textarea>';
                        }else{
                            $html .= '<textarea type="text" name="sup_final_output_'.$cell1.'[]" class="form-control"></textarea>';
                        }
                       $html .= '</td>';

                       /*Cell 9*/
                       $html .= '<td>';
                       if($row_values->$cell9 != null){
                        $html .= '<textarea type="text" name="reviewer_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell9[0].'</textarea>';
                    }else{
                        $html .= '<textarea type="text" name="reviewer_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                    }
                       $html .= '</td>';

                        /* cell10 */
                    //    $html .= '<td>';
                    //    if($row_values->$cell10 != null){
                    //     $html .= '<textarea type="text" name="reviewer_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell10[0].'</textarea>';
                    // }else{
                    //     $html .= '<textarea type="text" name="reviewer_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                    // }
                    //    $html .= '</td>';
                          $html .= '<td>';
                       if($row_values->$cell11 != null){
                           $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control">'.$row_values->$cell11[0].'</textarea>';
                       }else{
                           $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control"></textarea>';
                       }
                        $html .= '</td>';

                       $html .= '</tr>';
                       /*Cell 11*/




                }
        }
        if($reviewer==2){
        // echo json_encode('one');die();

            //teamleader reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;
                $cell10 =  "hr_remarks_".$cell1;
                $cell11 = "bh_sign_off_".$cell1;
                $html .= '<tr  class="border-bottom-primary">';

                    /*Cell 1*/
                    $html .= '<th scope="row">'.$cell1.'</th>';

                   /*Cell 2*/
                   if($row_values->$cell2 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell2 as $cell2_value){
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*Cell 3*/
                if($row_values->$cell3 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell3 as $cell3_value){
                            // dd($cell3_value);
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }



                /*Cell 4*/
                if($row_values->$cell4 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                 /*Cell 5*/
                if($row_values->$cell5 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }
                  /*Cell 6*/
                  if($row_values->$cell6 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                   /*Cell 7*/
                   $html .= '<td>';
                   if($row_values->$cell7 != null){
                   $html .= '<p>'.$row_values->$cell7[0].'</p>';
                   }
                   $html .= '</td>';

                   /*Cell 8*/
                   $html .= '<td>';
                   if($row_values->$cell8 != null){
                       $html .= '<p>'.$row_values->$cell8[0].'</p>';
                   }
                   $html .= '</td>';

                   /*Cell 9*/
                   $html .= '<td>';
                   if($row_values->$cell9 != null){
                    $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control">'.$row_values->$cell9[0].'</textarea>';
                }else{
                    $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control"></textarea>';
                }
                   $html .= '</td>';

                   //  cell 10
                //    $html .= '<td>';
                //    if($row_values->$cell10 != null){
                //    $html .= '<p>'.$row_values->$cell10[0].'</p>';
                //    }
                //    $html .= '</td>';

                   /*Cell 15*/
                   $html .= '<td>';
                   if($row_values->$cell11 != null){
                       $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control">'.$row_values->$cell11[0].'</textarea>';
                   }else{
                       $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control"></textarea>';
                   }
                    $html .= '</td>';

                $html .= '</tr>';

            }

        }
        if($reviewer==0){

                //    echo json_encode("one");die();
            //employee reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);
            // dd($datas);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;
                // $cell10 =  "hr_remarks_".$cell1;
                $cell11 = "bh_sign_off_".$cell1;

                $html .= '<tr  class="border-bottom-primary">';

                    /*Cell 1*/
                    $html .= '<th scope="row">'.$cell1.'</th>';

                    /*Cell 2*/
                    if($row_values->$cell2 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell2 as $cell2_value){
                                if($cell2_value != null){

                                    $html .= '<p>'.$cell2_value.'</p>';

                                }else{
                                    $html .= '<p></p>';

                                }
                            }

                            $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*Cell 3*/
                    if($row_values->$cell3 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell3 as $cell3_value){
                                // dd($cell3_value);
                                if($cell3_value != null){

                                    $html .= '<p>'.$cell3_value.'</p>';

                                }else{
                                    $html .= '<p></p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }



                    /*Cell 4*/
                    if($row_values->$cell4 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell4 as $cell4_value){
                                // dd($cell3_value);
                                if($cell4_value != null){

                                    $html .= '<p>'.$cell4_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                     /*Cell 5*/
                    if($row_values->$cell5 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell5 as $cell5_value){
                                // dd($cell3_value);
                                if($cell5_value != null){

                                    $html .= '<p>'.$cell5_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        // $html .= '<p></p>';
                        $html .= '</td>';
                    }
                      /*Cell 6*/
                      if($row_values->$cell6 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell6 as $cell6_value){
                                // dd($cell3_value);
                                if($cell6_value != null){

                                    $html .= '<p>'.$cell6_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '<p></p>';
                        $html .= '</td>';
                    }

                    /*Cell 7*/
                    $html .= '<td>';
                    if($row_values->$cell7 != null){
                    $html .= '<p>'.$row_values->$cell7[0].'</p>';
                    }
                    $html .= '</td>';

                    /*Cell 8*/
                    $html .= '<td>';
                    if($row_values->$cell8 != null){
                        $html .= '<p>'.$row_values->$cell8[0].'</p>';
                    }
                    $html .= '</td>';

                    /*Cell 9*/
                    $html .= '<td>';
                    if($row_values->$cell9 != null){
                        $html .= '<p>'.$row_values->$cell9[0].'</p>';
                    }
                    $html .= '</td>';

                    // //  cell 10
                    // $html .= '<td>';
                    // if($row_values->$cell10 != null){
                    // $html .= '<p>'.$row_values->$cell10[0].'</p>';
                    // }
                    // $html .= '</td>';

                    /*Cell 15*/
                    $html .= '<td>';
                    if($row_values->$cell11 != null){
                        $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control">'.$row_values->$cell11[0].'</textarea>';
                    }else{
                        $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control"></textarea>';
                    }
                    $html .= '</td>';

                $html .= '</tr>';

            }

        }


        return json_encode($html);
    }
    public function fetch_goals_setting_id_edit(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);
        $html = '';
        $random = mt_rand(10000, 99999);

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $sub_row_count = count($row_values->$cell3);

            $html .= '<tr>';

            /*Cell 1*/
            $html .= '<td scope="row">'.$cell1.'</td>';

            /*cell 2*/
            if($row_values->$cell2 != null){
                $html .= '<td>';
                    $html .= '<select class="form-control js-example-basic-single key_bus_drivers  m-t-5" name="key_bus_drivers_'.$cell1.'[]">';

                        $html .= '<option value="">...Select...</option>';

                        if($row_values->$cell2[0] == "Revenue"){
                            $html .= '<option value="Revenue" selected>Revenue</option>';
                        }else{
                            $html .= '<option value="Revenue">Revenue</option>';
                        }

                        if($row_values->$cell2[0] == "Customer"){
                            $html .= '<option value="Customer" selected>Customer</option>';
                        }else{
                            $html .= '<option value="Customer">Customer</option>';
                        }

                        if($row_values->$cell2[0] == "Process"){
                            $html .= '<option value="Process" selected>Process</option>';
                        }else{
                            $html .= '<option value="Process">Process</option>';
                        }

                        if($row_values->$cell2[0] == "People"){
                            $html .= '<option value="People" selected>People</option>';
                        }else{
                            $html .= '<option value="People">People</option>';
                        }

                        if($row_values->$cell2[0] == "Projects"){
                            $html .= '<option value="Projects" selected>Projects</option>';
                        }else{
                            $html .= '<option value="Projects">Projects</option>';
                        }

                    $html .= '</select>';
                $html .= '</td>';
            }else{
                $html .= '<td>';
                    $html .= '<select class="form-control js-example-basic-single key_bus_drivers m-t-5" name="key_bus_drivers_'.$cell1.'[]">';
                        $html .= '<option value="">...Select...</option>';
                        $html .= '<option value="Revenue">Revenue</option>';
                        $html .= '<option value="Customer">Customer</option>';
                        $html .= '<option value="Process">Process</option>';
                        $html .= '<option value="People">People</option>';
                        $html .= '<option value="Projects">Projects</option>';
                    $html .= '</select>';
                $html .= '</td>';
            }

            /*cell 3*/
            $html .= '<td>';
            // $html .= '<p>HR Shared Services : </p>';

            for($i=0; $i < $sub_row_count; $i++){

                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell3[$i] != null){

                    $html .= '<textarea name="key_res_areas_'.$cell1.'[] " id="" class="form-control '.$code.' m-t-5">'.$row_values->$cell3[$i].'</textarea>';

                }else{
                    $html .= '<textarea name="key_res_areas_'.$cell1.'[]" id="" class="form-control '.$code.' m-t-5"></textarea>';

                }

            }

            $html .= '</td>';

            /*cell 4*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){

                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell4[$i] != null){

                    $html .= '<textarea name="measurement_criteria_'.$cell1.'[] " id="" class="form-control '.$code.' m-t-5">'.$row_values->$cell4[$i].'</textarea>';

                }else{
                    $html .= '<textarea name="measurement_criteria_'.$cell1.'[]" id="" class="form-control '.$code.' m-t-5"></textarea>';

                }

            }
            $html .= '</td>';

            /*cell 5*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){

                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell5[$i] != null){

                    $html .= '<textarea name="self_assessment_remark_'.$cell1.'[] " id="" class="form-control '.$code.' m-t-5">'.$row_values->$cell5[$i].'</textarea>';

                }else{
                    $html .= '<textarea name="self_assessment_remark_'.$cell1.'[]" id="" class="form-control '.$code.' m-t-5"></textarea>';

                }

            }
            $html .= '</td>';

            /*cell 6*/       
            $html .= '<td>';
            
            for($i=0; $i < $sub_row_count; $i++){
                
                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell6[$i] != null){
                        $html .= '<select class="form-control js-example-basic-single key_bus_drivers m-t-20 '.$code.'" name="rating_by_employee_'.$cell1.'[]">';
    
                            $html .= '<option value="">...Select...</option>';
    
                            if($row_values->$cell6[$i] == "EE"){
                                $html .= '<option value="EE" selected>EE</option>';
                            }else{
                                $html .= '<option value="EE">EE</option>';
                            }
    
                            if($row_values->$cell6[$i] == "AE"){
                                $html .= '<option value="AE" selected>AE</option>';
                            }else{
                                $html .= '<option value="AE">AE</option>';
                            }
                            
                            if($row_values->$cell6[$i] == "ME"){
                                $html .= '<option value="ME" selected>ME</option>';
                            }else{
                                $html .= '<option value="ME">ME</option>';
                            }
                            
                            if($row_values->$cell6[$i] == "PE"){
                                $html .= '<option value="PE" selected>PE</option>';
                            }else{
                                $html .= '<option value="PE">PE</option>';
                            }
                            
                            if($row_values->$cell6[$i] == "ND"){
                                $html .= '<option value="ND" selected>ND</option>';
                            }else{
                                $html .= '<option value="ND">ND</option>';
                            }
    
                        $html .= '</select>';
                        
                }else{
                $html .= '<td>';
                    $html .= '<select class="form-control js-example-basic-single key_bus_drivers m-t-5" name="rating_by_employee_'.$cell1.'[]">';
                        $html .= '<option value="">...Select...</option>';
                        $html .= '<option value="EE">EE</option>';
                        $html .= '<option value="AE">AE</option>';
                        $html .= '<option value="ME">ME</option>';
                        $html .= '<option value="PE">PE</option>';
                        $html .= '<option value="ND">ND</option>';
                    $html .= '</select>';
                }
            }                

            /*Cell 8*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){
                $code = $cell1.'_'.$i.$i.$i.$i.$i;
                $html .='<div class="dropup m-t-20">';
                    $html .='<button type="button" class="btn btn-xs btn-danger '.$code.'" onclick="removeRow(this,'.$code.');" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
                $html .='</div>';
            }
            $html .='</td>';

            $html .='<td>';
                $html .='<div class="dropup m-t-5">';
                    $html .='<button type="button" class="btn btn-xs btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>';
                    $html .='<div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">';
                        $html .='<a class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,'.$cell1.');"></i></button></a>';
                        // html .='<a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button></a>';
                        $html .='<a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button"  id="btnDelete" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button></a>';
                    $html .='</div>';
                $html .='</div>';
                // html .='<div class="dropup m-t-5">';
                //     html .='<button type="button" class="btn btn-xs btn-info" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                // html .='</div>';
                // html .='<div class="dropup m-t-5">';
                //     html .='<button type="button" class="btn btn-xs btn-danger" id="btnDelete" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
                // html .='</div>';

                // html .=' <button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,0);"></i></button>';
                // html .=' <button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                // html .=' <button class="btn btn-danger btn-xs" type="button" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button>';
            $html .='</td>';

            $html .= '</tr>';

        }

        // dd($html);

        return json_encode($html);
    }
    public function add_goals_data(Request $request)
    {

        // dd(count($request->all()));die();
        $count = count($request->all())-1;
        $row_count = $count/5;
        // $row_count = count($request->all())/10;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "self_assessment_remark_$i" => $request->input('self_assessment_remark_'.$i.''),
                // "weightage_$i" => $request->input('weightage_'.$i.''),
                "rating_by_employee_$i" => $request->input('rating_by_employee_'.$i.''),
                // "rate_$i" => $request->input('rate_'.$i.''),
                // "actuals_$i" => $request->input('actuals_'.$i.''),
                // "self_remarks_$i" => $request->input('self_remarks_'.$i.''),
                // "self_assessment_rate_$i" => $request->input('self_assessment_rate_'.$i.''),
                "sup_remarks_$i" => "",
                "sup_final_output_$i" => "",
                "reviewer_remarks_$i" => "",
                "hr_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }

        $goal_process = json_encode($json); //convert to json
        // $json_stripslashes = stripslashes(json_encode($json)); //convert to json
        // dd($goal_process);

        $logined_empID = Auth::user()->empID;
        $logined_username = Auth::user()->username;
        $current_year = date("Y");
        $year = substr( $current_year, -2);
        $goal_data_count = Goals::where('created_by', $logined_empID)->get()->count();
        $total_count = $goal_data_count+1;
        $goal_name = 'Goal-'.$year.' '.$total_count;
        $rating_option_list_arr =  array("");

        //Data upload to server
        $data = array(
            'goal_name' => $goal_name,
            'goal_process' => $goal_process,
            'goal_status' => "Pending",
            'supervisor_status' => "0",
            'employee_tb_status' => "1",
            'reviewer_status' => "0",
            'hr_status' => "0",
            'bh_status' => "0",
            'goal_unique_code' => "",
            'created_by' => $logined_empID,
            'created_by_name' => $logined_username,
            'employee_consolidated_rate' => $request->employee_consolidated_rate,
        );

        $last_inserted_id = $this->goal->add_goals_insert($data);

        //Goals Unique code
        if(!empty($last_inserted_id)){
            $goal_code="G";
            $goal_unique_code = $goal_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->goal->insertGoalsCode($goal_unique_code, $last_inserted_id);
        }
        if($result){
            return json_encode($goal_unique_code);
        }
        // return response($result);

        // $result_1 = json_decode($result); //convert to json

        // for ($i=0; $i < count($result_1); $i++) {

        //    dd(json_decode($refetch_goals_sup_detailssult_1[$i]));

        // }

    }

    public function add_goals_data_hr_sup(Request $request)
    {
          // echo json_encode($request->all());die();


        // dd($request->all());
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);
        $json = array();

        $html = '';


        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values=json_decode($data);
            // echo json_encode($row_values);die();

            //Supervisor remark add
            $sup_remark_value = array($request->sup_remark_[$key]);
            $sup_rem = "sup_remarks_".$cell1;
            $row_values->$sup_rem = $sup_remark_value;

            $sup_rating_value = array($request->sup_final_output_[$key]);
            $sup_final_op = "sup_final_output_".$cell1;
            $row_values->$sup_final_op = $sup_rating_value;

            $sup_remarks_value = array($request->hr_remarks_[$key]);
            $sup_remarks = "hr_remarks_".$cell1;
            $row_values->$sup_remarks = $sup_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
        );
        // dd($data);
        $result = $this->goal->update_goals_sup($data);

        return response($result);
    }
    public function add_goals_data_hr_save(Request $request){
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);
        $json = array();

        $html = '';


        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values=json_decode($data);

            //Supervisor remark add
            $sup_remark_value = array($request->sup_remark_[$key]);
            $sup_rem = "sup_remarks_".$cell1;
            $row_values->$sup_rem = $sup_remark_value;

            $sup_rating_value = array($request->sup_final_output_[$key]);
            $sup_final_op = "sup_final_output_".$cell1;
            $row_values->$sup_final_op = $sup_rating_value;

            $sup_remarks_value = array($request->hr_remarks_[$key]);
            $sup_remarks = "hr_remarks_".$cell1;
            $row_values->$sup_remarks = $sup_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
        );
        // dd($data);
        // echo '11<pre>';print_r($data);die();
        $result = $this->goal->update_goals_sup_save($data);

        return response($result);
    }

    public function add_goals_data_submit(Request $request)
    {
        // dd(count($request->all()));die();
        $count = count($request->all())-1;
        $row_count = $count/5;
        // $row_count = count($request->all())/10;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "self_assessment_remark_$i" => $request->input('self_assessment_remark_'.$i.''),
                "rating_by_employee_$i" => $request->input('rating_by_employee_'.$i.''),
                "sup_remarks_$i" => "",
                "sup_final_output_$i" => "",
                "reviewer_remarks_$i" => "",
                "hr_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }

        $goal_process = json_encode($json); //convert to json
        // $json_stripslashes = stripslashes(json_encode($json)); //convert to json
        // dd($goal_process);

        $logined_empID = Auth::user()->empID;
        $logined_username = Auth::user()->username;
        $current_year = date("Y");
        $year = substr( $current_year, -2);
        $goal_data_count = Goals::where('created_by', $logined_empID)->get()->count();
        $total_count = $goal_data_count+1;
        $goal_name = 'Goal-'.$year.' '.$total_count;
        $rating_option_list_arr =  array("");

        //Data upload to server
        $data = array(
            'goal_name' => $goal_name,
            'goal_process' => $goal_process,
            'goal_status' => "Pending",
            'supervisor_status' => "0",
            'employee_tb_status' => "1",
            'employee_status' => "1",
            'reviewer_status' => "0",
            'hr_status' => "0",
            'bh_status' => "0",
            'goal_unique_code' => "",
            'created_by' => $logined_empID,
            'created_by_name' => $logined_username,
            'employee_consolidated_rate' => $request->employee_consolidated_rate,
        );

        $last_inserted_id = $this->goal->add_goals_insert($data);

        //Goals Unique code
        if(!empty($last_inserted_id)){
            $goal_code="G";
            $goal_unique_code = $goal_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->goal->insertGoalsCode($goal_unique_code, $last_inserted_id);
        }
        // if($result){
        //     // return json_encode($goal_unique_code);
        // }
        return response($result);

    }
    public function get_hr_goal_list_tb(Request $request){
         if ($request !="") {
                $input_details = array(
                'supervisor_list'=>$request->input('supervisor_list'),
                );
            }
            // echo "<pre>";print_r($input_details);die;

        $get_goal_list_result = $this->goal->get_hr_goal_list_tb($input_details);

        return DataTables::of($get_goal_list_result)
        ->addIndexColumn()
        ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
        ->addColumn('action', function($row) {
                if($row->goal_status == "Pending" || $row->goal_status == "Revert"){
                    // $btn = '<div class="dropup">
                    //         <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    //         <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                    //             <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    //         </div>
                    //     </div>' ;
                 $btn = '<div class="dropup">

                    <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>

                    </div>' ;

                }elseif($row->goal_status == "Approved"){
                    // echo "<pre>";print_r("2s");die;
                    $id = $row->goal_unique_code;
                    $result = $this->goal->check_goals_employee_summary($id);

                    if($result == "Yes"){
                        /*$btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                                </div>
                            </div>' ;*/
                            $btn = '<div class="dropup">

                                <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>

                                </div>' ;
                    }else{
                        /*echo "<pre>";print_r("3s");die;
                        $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-edit"></i></button></a>
                                </div>
                            </div>' ;*/
                        $btn = '<div class="dropup">
                                <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                                </div>' ;
                    }

                }
            return $btn;
        })

        ->rawColumns(['action','status'])
        ->make(true);
    }
    public function get_goal_list(){

        $get_goal_list_result = $this->goal->get_goal_list();

        return DataTables::of($get_goal_list_result)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){

                    if($row->employee_status == "0" || $row->employee_status == null){
                        $btn = '<div class="dropup">
                            <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                <a href="goal_setting_edit?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                            </div>
                        </div>' ;
                    }else{
                        $btn = '<div class="dropup">
                            <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            </div>
                        </div>' ;
                    }

                }elseif($row->goal_status == "Revert"){

                    $btn = '<div class="dropup">
                        <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                        <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                            <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        </div>
                    </div>' ;

                }elseif($row->goal_status == "Approved"){
                    // $btn = '<div class="dropup">
                    // <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    // <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                    //     <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    // </div>
                    // </div>' ;
                    $id = $row->goal_unique_code;
                    $result = $this->goal->check_goals_employee_summary($id);

                    if($result == "Yes"){
                        $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                                </div>
                            </div>' ;
                    }else{
                        $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-edit"></i></button></a>
                                </div>
                            </div>' ;
                    }

                }

            // <a class="dropdown-item ditem-gs deleteRecord"  data-id="'.$row->goal_unique_code.'"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>

            return $btn;
        })

        ->rawColumns(['action'])
        ->make(true);

    }

    public function get_team_member_goal_list(Request $request){

        if ($request !="") {
            $input_details = array(
            'team_member_filter'=>$request->input('team_member_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_team_member_goal_list($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    $id = $row->goal_unique_code;
                    $result = $this->goal->check_goals_employee_summary($id);

                    if($result == "Yes"){
                        $btn = '<div class="dropup">
                                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                        <a href="goal_setting_supervisor_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                        <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show_fn" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                                    </div>
                                </div>' ;
                    }else{                        
                        $btn = '<div class="dropup">
                                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                        <a href="goal_setting_supervisor_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    </div>
                                </div>' ;
                    }
                    // <a href="goal_setting_supervisor_edit?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>

                return $btn;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }

    }
    public function get_reviewer_goal_list(Request $request){

        if ($request !="") {
            $input_details = array(
            'team_leader_filter'=>$request->input('team_leader_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_reviewer_goal_list($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    // $btn = '<div class="dropup">
                    // <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    // <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                    //     <a href="goal_setting_reviewer_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    // </div>
                    // </div>' ;
                    $btn = '<div class="dropup">
                    <a href="goal_setting_reviewer_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                    </div>' ;

                return $btn;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }

    }
    public function get_bh_goal_list(Request $request){

        if ($request !="") {
            $input_details = array(
                'reviewer_filter'=>$request->input('reviewer_filter'),
                'team_leader_filter'=>$request->input('team_leader_filter'),
                'team_member_filter'=>$request->input('team_member_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_bh_goal_list($input_details);
            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;



                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }else{
                    $btn = '';
                }
                //  echo "<pre>";print_r($btn);die;
                return $btn;
            })
            ->addColumn('action', function($row) {
                        $btn1 = '<div class="dropup">
                        <a href="goal_setting_bh_reviewer_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                        </div>' ;

                return $btn1;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }

    }
    public function get_hr_goal_list_record(Request $request){

        if ($request !="") {
            $input_details = array(
                'reviewer_filter'=>$request->input('reviewer_filter'),
                'team_leader_filter'=>$request->input('team_leader_filter'),
                'team_member_filter'=>$request->input('team_member_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_bh_goal_list($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        <a href="goal_setting_hr_edit?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                    </div>
                    </div>' ;

                return $btn;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }

    }
    public function goals_delete(Request $request){
        $id = $request->id;
        $result = $this->goal->fetchGoalIdDelete($id);
        return response($result);
    }
    public function goals_employee_summary(Request $request){
        $id = $request->id;
        $employee_summary = $request->employee_summary;
        $result = $this->goal->addGoalEmployeeSummary($id, $employee_summary);
        return response($result);
    }
    public function update_goals_data(Request $request)
    {
        // dd($request->all());die();
        $count = count($request->all())-1;
        $row_count = $count/10;
        // $row_count = $count/6;
        $code = $request->edit_id;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "sub_indicators_$i" => $request->input('sub_indicators_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "weightage_$i" => $request->input('weightage_'.$i.''),
                "reference_$i" => $request->input('reference_'.$i.''),
            ]);

        }

        $goal_process = json_encode($json); //convert to json
        // $json_stripslashes = stripslashes(json_encode($json)); //convert to json
        // dd($goal_process);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $code,
        );

        $result = $this->goal->add_goals_update($data);

        return response($result);
    }
    public function add_goal_btn(){
        $result = $this->goal->add_goal_btn();
        // dd($result)        ;
        return json_encode($result);
    }
    public function goals_status(Request $request){
        //Data upload to server
        $data = array(
            'goal_status' => $request->goals_status,
            'goal_unique_code' => $request->id,
        );
        $result = $this->goal->goals_status_update($data);
        return response($result);

    }
    public function fetch_supervisor_filter(Request $request){
        $supervisor_filter = $request->supervisor_filter;
        $result = $this->goal->fetch_supervisor_filter($supervisor_filter);
        return json_encode($result);
    }
    public function fetch_reviewer_filter(Request $request){
        $reviewer_filter = $request->reviewer_filter;
        $result = $this->goal->fetch_reviewer_filter($reviewer_filter);
        return json_encode($result);
    }
    public function fetch_team_leader_filter(Request $request){
        $team_leader_filter = $request->team_leader_filter;
        $result = $this->goal->fetch_team_leader_filter($team_leader_filter);
        return json_encode($result);
    }
    public function fetch_goals_employee_summary(Request $request){
        $id = $request->id;
        // echo "<pre>as";print_r($id);die;
        $result = $this->goal->fetch_goals_employee_summary($id);
        return json_encode($result);
    }
    public function fetch_goals_supervisor_summary(Request $request){
        $id = $request->id;
        // echo "<pre>as";print_r($id);die;
        $result = $this->goal->fetch_goals_supervisor_summary($id);
        return json_encode($result);
    }
    public function goals_supervisor_summary(Request $request){
        $id = $request->id;
        $employee_summary = $request->employee_summary;
        $result = $this->goal->goals_supervisor_summary($id, $employee_summary);
        return response($result);
    }
    public function update_goals_sup(Request $request){
        dd($request->all());
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            //Supervisor remark add
            $sup_remark_value = array($request->sup_remark[$key]);
            $sup_rem = "sup_remarks_".$cell1;
            $row_values->$sup_rem = $sup_remark_value;

            //Supervisor rating add
            $sup_rating_value = array($request->sup_rating[$key]);
            $sup_final_op = "sup_final_output_".$cell1;
            $row_values->$sup_final_op = $sup_rating_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);
        // dd($goal_process);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
        );
        $result = $this->goal->update_goals_sup($data);

        return response($result);
    }
    public function update_goals_sup_submit(Request $request){
        // dd($request->all());
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            //Supervisor remark add
            $sup_remark_value = array($request->sup_remark[$key]);
            $sup_rem = "sup_remarks_".$cell1;
            $row_values->$sup_rem = $sup_remark_value;

            //Supervisor rating add
            $sup_rating_value = array($request->sup_rating[$key]);
            $sup_final_op = "sup_final_output_".$cell1;
            $row_values->$sup_final_op = $sup_rating_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        // dd($json);

        $goal_process = json_encode($json);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
        );
        // dd($data);
        $result = $this->goal->update_goals_sup_submit($data);

        return response($result);
    }
    /*hr goal list*/
    public function get_hr_goal_list(Request $request){

        if ($request !="") {
            $input_details = array(
            'team_leader_filter'=>$request->input('team_leader_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_reviewer_goal_list($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting_reviewer_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        <a href="goal_setting_reviewer_edit?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                    </div>
                    </div>' ;

                return $btn;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }
    }

    public function get_team_member_list(Request $request){
        $id = $request->supervisor_list_1;
        $result = $this->goal->fetch_team_member_list($id);
        return json_encode($result);
    }

    public function get_hr_supervisor(){
        $hr_supervisor ="900531";
        $result = $this->goal->get_supervisor_hr($hr_supervisor);
        return json_encode($result);
    }
    public function get_manager_lsit_drop(Request $request){
        $id = $request->reviewer_filter;
        // echo "<pre>";print_r($id);die;
        $result = $this->goal->get_manager_lsit($id);
        return json_encode($result);
    }
    public function get_team_member_drop(Request $request){
        $id = $request->team_leader_filter_hr;
        $result = $this->goal->get_team_member_drop_list($id);
        return json_encode($result);
    }
    public function hr_list_tab_record(Request $request){
         if ($request !="") {
            $input_details = array(
                'reviewer_filter_1'=>$request->input('reviewer_filter_1'),
                'team_leader_filter_hr_1'=>$request->input('team_leader_filter_hr_1'),
                'team_member_filter_hr_1'=>$request->input('team_member_filter_hr_1'),
                'gender_hr_1'=>$request->input('gender_hr_1'),
                'grade_hr_1'=>$request->input('grade_hr_1'),
                'department_hr_1'=>$request->input('department_hr_1'),
            );
        }

        if ($request->ajax()) {
        $result = $this->goal->gethr_list_tab_record($input_details);
        // echo "<pre>";print_r($result['textbox']);die;

        return DataTables::of($result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->rawColumns(['status'])
            ->make(true);
        }
    }
/*after cick in hr submit button*/
     public function get_hr_goal_list_tbl(Request $request){

        if ($request !="") {
            $input_details = array(
                'reviewer_filter'=>$request->input('reviewer_filter'),
                'team_leader_filter_hr'=>$request->input('team_leader_filter_hr'),
                'team_member_filter_hr'=>$request->input('team_member_filter_hr'),
                'gender_hr_2'=>$request->input('gender_hr_2'),
                'grade_hr_2'=>$request->input('grade_hr_2'),
                'department_hr_2'=>$request->input('department_hr_2'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_hr_goal_list_for_tbl($input_details);

            //   echo json_encode($get_goal_list_result);die();


            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;
                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }else{
                    $btn = '';
                }
                //  echo "<pre>";print_r($btn);die;
                return $btn;
            })
            ->addColumn('action', function($row) {
                    $btn1 = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    </div>
                    </div>' ;


                return $btn1;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }

    }

    public function check_goal_sheet_role_type_hr(Request $request)
    {
        $id = $request->id;
        $result = $this->goal->checkHrReviewerIDOrNot($id);

        return json_encode($result);
    }



//vignesh code for supervisor wise check data



//for get filter supervisor data
 public function select_supervisor_data_bh(Request $request)
 {
       $id=$request->id;
       $logined_empID = Auth::user()->empID;
       if(is_null($id)) {
                $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
                ->where('customusers.sup_emp_code',$logined_empID)
                ->select('goals.*')->get();
      }
      else {
        $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
                            ->where('customusers.empID',$id)
                            ->select('goals.*')->get();

      }
      $result=json_decode($result);
   echo json_encode($result);

 }

//get user_goals info under reviewer by vignesh

 public function select_reviewer_data_bh()
 {
    $logined_empID = Auth::user()->empID;
    $users_under_reviewer=CustomUser::where('sup_emp_code',$logined_empID)
                                      ->select('customusers.username','customusers.empID')->get();
    $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
    ->where('customusers.reviewer_emp_code',$logined_empID)
    ->where('customusers.sup_emp_code','!=',$logined_empID)
    ->where('goals.supervisor_status','1')
    ->select('goals.*')->get();
    $result=json_decode($result);
    $data['result']=$result;
    $data['user_info_unser_reviewer']=$users_under_reviewer;
    echo json_encode($data);

 }
 //get user_goals reviewer filter
 public function select_reviewer_filter_bh(Request $request)
 {
        $data=$request->data;
        // echo json_encode($data[0]['sup_id']);
        $id=$data[0]['id'];
        if($id==1){
               $user_info=CustomUser::where('sup_emp_code',$data['0']['sup_id'])->get();
               $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
               ->where('customusers.sup_emp_code',$data['0']['sup_id'])
               ->where('customusers.empID',$data['0']['emp_id'])
               ->where('goals.supervisor_status','1')
               ->select('goals.*')->get();
               $result=json_decode($result);
               $final['status']='1';
               $final['result']=$result;
               $final['user_info']=$user_info;
        }
        if($id==2){
               $user_info=CustomUser::where('sup_emp_code',$data['0']['sup_id'])->get();
               $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
               ->where('customusers.sup_emp_code',$data['0']['sup_id'])
               ->where('goals.supervisor_status','1')
               ->select('goals.*')->get();
               $result=json_decode($result);
               $final['status']='2';
               $final['result']=$result;
               $final['user_info']=$user_info;
        }

        echo json_encode($final);
 }
 //get all user details

 public function select_all_member_info()
 {
    $logined_empID = Auth::user()->empID;
    $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
    ->where('customusers.sup_emp_code','!=',$logined_empID)
    ->where('customusers.reviewer_emp_code','!=',$logined_empID)
    ->where('goals.supervisor_status','1')
    ->where('goals.reviewer_status','1')
    ->select('goals.*')->get();

    $result=json_decode($result);
    echo json_encode($result);


 }




function get_all_memer_filter_url(Request $request){
    if ($request !="") {
        $input_details = array(
            'reviewer_filter'=>$request->input('reviewer_filter'),
            'team_leader_filter'=>$request->input('team_leader_filter'),
            'team_member_filter'=>$request->input('team_member_filter'),
        );
    }
}


public function get_all_supervisors_info_bh()
{

    $logined_empID = Auth::user()->empID;
    $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
    ->where('customusers.sup_emp_code',$logined_empID)
    ->select('goals.*')->get();
    $result=json_decode($result);
    echo json_encode($result);
}


    public function get_grade()
    {
        $result = DB::select("SELECT grade FROM customusers GROUP by grade");
        return json_encode($result);
    }
    public function get_department()
    {
        $result = DB::select("SELECT department FROM customusers GROUP by department");
        return json_encode($result);
    }

    public function get_reviewer_goal_list_for_reviewer(Request $request){

        if ($request !="") {
            $input_details = array(
            'team_leader_filter_for_reviewer'=>$request->input('team_leader_filter_for_reviewer'),
            'team_member_filter'=>$request->input('team_member_filter'),
            );
        }
        // echo '<pre>';print_r($input_details);die();

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_reviewer_goal_list_for_reviewer($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    $btn = '<div class="dropup">
                    <a href="goal_setting_reviewer_view?id='.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                    </div>' ;

                return $btn;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }

    }

    public function get_goal_setting_reviewer_details_tl(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );
        // echo 'test<pre>';print_r($input_details);die();

        $get_reviewer_details_tl_result = $this->goal->get_goal_setting_reviewer_details_tl( $input_details );

        return response()->json( $get_reviewer_details_tl_result );
    }
    public function update_emp_goals_data(Request $request){
        // dd(($request->all()));die();

        $id = $request->goals_setting_id;

        $count = count($request->all())-2;
        $row_count = $count/5;
        // $row_count = count($request->all())/10;
        // dd($row_count);die();

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "self_assessment_remark_$i" => $request->input('self_assessment_remark_'.$i.''),
                // "weightage_$i" => $request->input('weightage_'.$i.''),
                "rating_by_employee_$i" => $request->input('rating_by_employee_'.$i.''),
                "sup_remarks_$i" => "",
                "sup_final_output_$i" => "",
                "reviewer_remarks_$i" => "",
                "hr_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }
        // dd($json);
        $goal_process = json_encode($json); //convert to json

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'employee_consolidated_rate' => $request->employee_consolidated_rate,
        );

        $result = $this->goal->update_emp_goals_data($data);

        return response($result);
    }

    public function update_emp_goals_data_submit(Request $request){
        // dd(($request->all()));die();

        $id = $request->goals_setting_id;

        $count = count($request->all())-2;
        $row_count = $count/5;
        // $row_count = count($request->all())/10;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "self_assessment_remark_$i" => $request->input('self_assessment_remark_'.$i.''),
                // "weightage_$i" => $request->input('weightage_'.$i.''),
                "rating_by_employee_$i" => $request->input('rating_by_employee_'.$i.''),
                "sup_remarks_$i" => "",
                "sup_final_output_$i" => "",
                "reviewer_remarks_$i" => "",
                "hr_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }
        // dd($json);

        $goal_process = json_encode($json); //convert to json

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'employee_consolidated_rate' => $request->employee_consolidated_rate,
        );

        $result = $this->goal->update_emp_goals_data_submit($data);

        return json_encode($result);
    }

     public function get_goal_myself_listing(){

        $get_goal_list_result = $this->goal->get_goal_myself_list();

        return DataTables::of($get_goal_list_result)
        ->addIndexColumn()
        ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
        ->addColumn('action', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending" || $row->goal_status == "Revert"){
                    $btn = '<div class="dropup">
                            <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            </div>
                        </div>' ;

                }elseif($row->goal_status == "Approved"){

                    $id = $row->goal_unique_code;
                    $result = $this->goal->check_goals_employee_summary($id);

                    if($result == "Yes"){
                        $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                                </div>
                            </div>' ;
                    }else{
                        $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-edit"></i></button></a>
                                </div>
                            </div>' ;
                    }

                }

            return $btn;
        })

        ->rawColumns(['action','status'])
        ->make(true);
          }

    public function update_goals_sup_reviewer_tm(Request $request){
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        // echo "<pre>";print_r($json_value);die;
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            //Reviewer remarks add
            $reviewer_remarks_value = array($request->reviewer_remarks_[$key]);
            $sup_final_op = "reviewer_remarks_".$cell1;
            $row_values->$sup_final_op = $reviewer_remarks_value;

            $hr_remarks_value = array($request->hr_remarks_[$key]);
            $sup_final_hr = "hr_remarks_".$cell1;
            $row_values->$sup_final_hr = $hr_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id
        );
        // dd($data);
        $result = $this->goal->update_goals_sup_reviewer_tm($data);

        return response($result);
    }

     public function update_goals_sup_reviewer_tm_save(Request $request){
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        // echo "<pre>";print_r($json_value);die;
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            //Reviewer remarks add
            $reviewer_remarks_value = array($request->reviewer_remarks_[$key]);
            $sup_final_op = "reviewer_remarks_".$cell1;
            $row_values->$sup_final_op = $reviewer_remarks_value;

            $hr_remarks_value = array($request->hr_remarks_[$key]);
            $sup_final_hr = "hr_remarks_".$cell1;
            $row_values->$sup_final_hr = $hr_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);



        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id
        );
        // dd($data);
        $result = $this->goal->update_goals_sup_reviewer_tm_save($data);

        return response($result);
    }

    public function update_goals_hr_reviewer_tm(Request $request){

        // echo "<pre>";print_r($json_value);die;    

        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            $hr_remarks_value = array($request->hr_remarks_[$key]);
            $sup_final_hr = "hr_remarks_".$cell1;
            $row_values->$sup_final_hr = $hr_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);



        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id
        );
        // dd($data);
        $result = $this->goal->update_goals_hr_reviewer_tm($data);

        return response($result);
    }
    public function save_hr_reviewer(Request $request){

        // echo "<pre>";print_r($json_value);die;    

        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            $hr_remarks_value = array($request->hr_remarks_[$key]);
            $sup_final_hr = "hr_remarks_".$cell1;
            $row_values->$sup_final_hr = $hr_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);



        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id
        );
        // dd($data);
        $result = $this->goal->save_goals_hr_reviewer_tm($data);

        return response($result);
    }




public function update_bh_goals(Request $request)
{
    //    echo json_encode($request->all());die();
     $id = $request->goals_setting_id;
     $reviewer_id=$request->reviewer_hidden_id;
     $json_value = $this->goal->fetchGoalIdDetails($id);
     $datas = json_decode($json_value);

     $json = array();

     $html = '';

     foreach($datas as $key=>$data){
         $cell1 = $key+1;
         $row_values = json_decode($data);
         //Reviewer remarks add
         $bh_sign_off_value = array($request->bh_sign_off_[$key]);
         $bh_sign_off = "bh_sign_off_".$cell1;
         $row_values->$bh_sign_off = $bh_sign_off_value;
         $supervisor_rating = array($request->sup_final_output_[$key]);
         $sup_final_op = "sup_final_output_".$cell1;
         $row_values->$sup_final_op = $supervisor_rating;
         $json_format = json_encode($row_values);
         array_push($json, $json_format);

     }
    //   echo json_encode($json);die();
     $goal_process = json_encode($json);
     //Data upload to server
     $data = array(
         'goal_process' => $goal_process,
         'bh_tb_status' => '1',
         'goal_status'=>$request->Bh_sheet_approval
     );
     if($request->reviewer_hidden_id ==1 || $request->reviewer_hidden_id==2){
           $data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
    }
     $result=Goals::where('goal_unique_code',$id)->update($data);
     if($result){
         $response=array('success'=>1,"message"=>"Data Updated Successfully");
     }
     else{
        $response=array('success'=>1,"message"=>"Problem in Updating Data");
     }

    //  return response($response);
    echo json_encode($response);
}


 public function Change_Bh_status(request $request)
 {

    $id = $request->goals_setting_id;
    $reviewer_id=$request->reviewer_hidden_id;
    $json_value = $this->goal->fetchGoalIdDetails($id);
    $datas = json_decode($json_value);

    $json = array();

    $html = '';

    foreach($datas as $key=>$data){
        $cell1 = $key+1;
        $row_values = json_decode($data);
        //Reviewer remarks add
        $bh_sign_off_value = array($request->bh_sign_off_[$key]);
        $bh_sign_off = "bh_sign_off_".$cell1;
        $row_values->$bh_sign_off = $bh_sign_off_value;
        $supervisor_rating = array($request->sup_final_output_[$key]);
        $sup_final_op = "sup_final_output_".$cell1;
        $row_values->$sup_final_op = $supervisor_rating;
        $json_format = json_encode($row_values);
        array_push($json, $json_format);

    }
   //   echo json_encode($json);die();
    $goal_process = json_encode($json);
    //Data upload to server
    $data = array(
        'goal_process' => $goal_process,
        'bh_tb_status' => '1',
        'goal_status'=>$request->Bh_sheet_approval
    );
//     if($request->reviewer_hidden_id ==1 || $request->reviewer_hidden_id==2){
//           $data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
//    }

if($request->reviewer_hidden_id==1){
       $data['supervisor_status']='1';
       $data['reviewer_status']='1';
       $data['bh_status']='1';
       $data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
}
if($request->reviewer_hidden_id==2){
    $data['reviewer_status']='1';
    $data['bh_status']='1';
    $data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;

}
if($request->reviewer_hidden_id==0){
    $data['bh_status']='1';
}
    $result=Goals::where('goal_unique_code',$id)->update($data);
    if($result){
        $response=array('success'=>1,"message"=>"Data Updated Successfully");
    }
    else{
       $response=array('success'=>1,"message"=>"Problem in Updating Data");
    }

    echo json_encode($response);













        // if($request->user_type==1){
        //      $data=array('supervisor_status'=>1,
        //                 'reviewer_status'=>1,
        //                 'bh_status'=>1);
        // }
        // elseif($request->user_type==2){
        //     $data=array(
        //     'reviewer_status'=>1,
        //     'bh_status'=>1);
        // }
        // else{
        //     $data=array(
        //         'bh_status'=>1);
        // }

        // $result=Goals::where('goal_unique_code',$request->id)->update($data);
        // if($result){
        //     $response=array('success'=>1,"message"=>"Data Updated Successfully");
        // }
        // else{
        //    $response=array('success'=>1,"message"=>"Problem in Updating Data");
        // }
        // echo json_encode($response);

 }


public function pms_employeee_mail(request $request)
{
      
      $i=0;
      foreach($request->gid as $data){
        // DB::enableQueryLog();
          $result=Goals::join('customusers','customusers.empID','=','goals.created_by')
                  ->where('goals.goal_unique_code',$data['checkbox'])->select('email')->get();
        /*email*/
           $Mail['email']=$result[$i]['email'];
                  // echo json_encode($Mail['email']);die;

                    // $Mail['email']='vigneshb@hemas.in';
                    $Mail['subject']="Thank you for submitting the details.";
                
                    Mail::send('emails.pms_emp_mail', $Mail, function ($message) use ($Mail) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    $message->to($Mail['email'])->subject($Mail['subject']);
                    });
       $i++;
      }
    echo json_encode($myarr);

}



}
