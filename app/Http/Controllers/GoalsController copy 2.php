<?php

namespace App\Http\Controllers;

use App\Repositories\IGoalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Goals;
use Auth;

class GoalsController extends Controller
{
    public function __construct(IGoalRepository $goal)
    {        
        $this->middleware('is_admin');
        $this->goal = $goal;
    }
    public function goals()
    {
        $result = $this->goal->checkCustomUserList();
        $team_member_list = $this->goal->fetchTeamMemberList();
        $supervisor_list = $this->goal->fetchTeamMemberList();
        if($result == "Reviewer"){
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
    public function goal_setting_reviewer_edit()
    {
        return view('goals.goal_setting_reviewer_edit');
    } 
    // public function goal_setting_supervisor_view()
    // {
    //     return view('goals.goal_setting_supervisor_view');
    // }  
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
            $cell4 = "sub_indicators_".$cell1;
            $cell5 = "measurement_criteria_".$cell1;
            $cell6 = "weightage_".$cell1;
            $cell7 = "reference_".$cell1;
            $cell8 = "rate_".$cell1;
            $cell9 = "actuals_".$cell1;
            $cell10 = "self_remarks_".$cell1;
            $cell11 = "self_assessment_rate_".$cell1;
            $cell12 = "sup_remarks_".$cell1;
            $cell13 = "sup_rating_".$cell1;
            $cell14 = "reviewer_remarks_".$cell1;
            $cell15 = "bh_sign_off_".$cell1;

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
            if($row_values->$cell7 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell7 as $cell7_value){
                        // dd($cell3_value);
                        if($cell7_value != null){
                            
                            $html .= '<p>'.$cell7_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 8*/
            if($row_values->$cell8 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell8 as $cell8_value){
                        // dd($cell3_value);
                        if($cell8_value != null){
                            
                            $html .= '<p>'.$cell8_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 9*/
            if($row_values->$cell9 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell9 as $cell9_value){
                        // dd($cell3_value);
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
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell11 as $cell11_value){
                        // dd($cell3_value);
                        if($cell11_value != null){
                            
                            $html .= '<p>'.$cell11_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*cell 12*/
            if($row_values->$cell12 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell12 as $cell12_value){
                        // dd($cell3_value);
                        if($cell12_value != null){
                            
                            $html .= '<p>'.$cell12_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }
            
             /*cell 13*/
             if($row_values->$cell13 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell13 as $cell13_value){
                        // dd($cell3_value);
                        if($cell13_value != null){
                            
                            $html .= '<p>'.$cell13_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }
            
             /*cell 14*/
             if($row_values->$cell14 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell14 as $cell14_value){
                        // dd($cell3_value);
                        if($cell14_value != null){
                            
                            $html .= '<p>'.$cell14_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }
            
             /*cell 15*/
             if($row_values->$cell15 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell15 as $cell15_value){
                        // dd($cell3_value);
                        if($cell15_value != null){
                            
                            $html .= '<p>'.$cell15_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }
            
            $html .= '</tr>';
            
        }

        // dd($html);

        return json_encode($html);
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
            $cell4 = "sub_indicators_".$cell1;
            $cell5 = "measurement_criteria_".$cell1;
            $cell6 = "weightage_".$cell1;
            $cell7 = "reference_".$cell1;
            $cell9 = "sup_review_".$cell1;
            $cell8 = "sup_weightage_".$cell1;
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
            if($row_values->$cell7 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell7 as $cell7_value){
                        // dd($cell3_value);
                        if($cell7_value != null){
                            
                            $html .= '<p>'.$cell7_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

             /*Cell 8*/
             $html .= '<td>';                
             if($row_values->$cell8 != null){                    
                 $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control">'.$row_values->$cell8[0].'</textarea>';
             }else{
                 $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control"></textarea>';
             }                                             
             $html .= '</td>';

            /*Cell 9*/
            $html .= '<td>';                
            if($row_values->$cell9 != null){                    
                $html .= '<input type="text" name="sup_weightage_'.$cell1.'[]" value="'.$row_values->$cell9[0].'" class="form-control">';
            }else{
                $html .= '<input type="text" name="sup_weightage_'.$cell1.'[]" class="form-control">';
            }                                             
            $html .= '</td>';

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

            $html .= '</tr>';
            
        }

        // dd($html);

        return json_encode($html);
    }
    public function fetch_goals_reviewer_edit(Request $request)
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
            $cell4 = "sub_indicators_".$cell1;
            $cell5 = "measurement_criteria_".$cell1;
            $cell6 = "weightage_".$cell1;
            $cell7 = "reference_".$cell1;
            $cell9 = "sup_review_".$cell1;
            $cell8 = "sup_weightage_".$cell1;
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
            if($row_values->$cell7 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell7 as $cell7_value){
                        // dd($cell3_value);
                        if($cell7_value != null){
                            
                            $html .= '<p>'.$cell7_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

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

            $html .= '</tr>';
            
        }

        // dd($html);

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
            $cell4 = "sub_indicators_".$cell1;
            $cell5 = "measurement_criteria_".$cell1;
            $cell6 = "weightage_".$cell1;
            $cell7 = "reference_".$cell1;
            $sub_row_count = count($row_values->$cell3);

            $html .= '<tr>';

            /*Cell 1*/
            $html .= '<td scope="row">'.$cell1.'</td>';

            /*Cell 2*/
            if($row_values->$cell2 != null){
                $html .= '<td>';                
                    $html .= '<select class="form-control js-example-basic-single key_bus_drivers  m-t-5" name="key_bus_drivers_'.$cell1.'[]">';

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
                        $html .= '<option value="Revenue">Revenue</option>';
                        $html .= '<option value="Customer">Customer</option>';
                        $html .= '<option value="Process">Process</option>';
                        $html .= '<option value="People">People</option>';
                        $html .= '<option value="Projects">Projects</option>';
                    $html .= '</select>';
                $html .= '</td>';
            }                  

            /*Cell 3*/

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

            /*Cell 4*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){
                
                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell4[$i] != null){
                    
                    $html .= '<textarea name="sub_indicators_'.$cell1.'[] " id="" class="form-control '.$code.' m-t-5">'.$row_values->$cell4[$i].'</textarea>';

                }else{
                    $html .= '<textarea name="sub_indicators_'.$cell1.'[]" id="" class="form-control '.$code.' m-t-5"></textarea>';

                }

            }                                       
            $html .= '</td>';

            /*Cell 5*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){
                
                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell5[$i] != null){
                    
                    $html .= '<textarea name="measurement_criteria_'.$cell1.'[] " id="" class="form-control '.$code.' m-t-5">'.$row_values->$cell5[$i].'</textarea>';

                }else{
                    $html .= '<textarea name="measurement_criteria_'.$cell1.'[]" id="" class="form-control '.$code.' m-t-5"></textarea>';

                }

            }                                       
            $html .= '</td>';

            /*Cell 6*/
            $html .= '<td>';
                
            if($row_values->$cell6[0] != null){                    
                $html .= '<input type="text" name="weightage_'.$cell1.'[]" value="'.$row_values->$cell6[0].'" class="form-control">';
            }else{
                $html .= '<input type="text" name="weightage_'.$cell1.'[]" class="form-control">';
            }                                             
            $html .= '</td>';

            /*Cell 7*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){
                
                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell7[$i] != null){
                    
                    $html .= '<textarea name="reference_'.$cell1.'[] " id="" class="form-control '.$code.' m-t-5">'.$row_values->$cell7[$i].'</textarea>';

                }else{
                    $html .= '<textarea name="reference_'.$cell1.'[]" id="" class="form-control '.$code.' m-t-5"></textarea>';

                }

            }                                       
            $html .= '</td>';            

            /*Cell 8*/
            $html .= '<td>';                       
            for($i=0; $i < $sub_row_count; $i++){
                $code = $cell1.'_'.$i.$i.$i.$i.$i;
                $html .='<div class="dropup m-t-35">';
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
        // dd($request->all());die();
        // $row_count = count($request->all())/6;
        $row_count = count($request->all())/10;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "sub_indicators_$i" => $request->input('sub_indicators_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "weightage_$i" => $request->input('weightage_'.$i.''),
                "reference_$i" => $request->input('reference_'.$i.''),
                "rate_$i" => "",
                "actuals_$i" => "",
                "self_remarks_$i" => "",
                "self_assessment_rate_$i" => "",
                "sup_remarks_$i" => "",
                "sup_rating_$i" => "",
                "reviewer_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }    

        $goal_process = json_encode($json); //convert to json
        // $json_stripslashes = stripslashes(json_encode($json)); //convert to json

        $logined_empID = Auth::user()->empID;        
        $logined_username = Auth::user()->username;        
        $current_year = date("Y");
        $year = substr( $current_year, -2);
        $goal_data_count = Goals::where('created_by', $logined_empID)->get()->count();
        $total_count = $goal_data_count+1;
        $goal_name = 'Goal-'.$year.' '.$total_count;
        
        //Data upload to server
        $data = array(
            'goal_name' => $goal_name,
            'goal_process' => $goal_process,
            'goal_status' => "Pending",
            'goal_unique_code' => "",
            'created_by' => $logined_empID,
            'created_by_name' => $logined_username,
        );

        $last_inserted_id = $this->goal->add_goals_insert($data);        

        //Goals Unique code
        if(!empty($last_inserted_id)){
            $goal_code="G";				
            $goal_unique_code = $goal_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->goal->insertGoalsCode($goal_unique_code, $last_inserted_id);           
        }     

        return response($result);

        // $result_1 = json_decode($result); //convert to json

        // for ($i=0; $i < count($result_1); $i++) {

        //    dd(json_decode($result_1[$i]));

        // }   

    } 
    public function get_goal_list(){

        $get_goal_list_result = $this->goal->get_goal_list();

        return DataTables::of($get_goal_list_result)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
                // echo "<pre>";print_r($row);die;
                // if($row->goal_status == "Pending" || $row->goal_status == "Revert"){
                //     $btn = '<div class="dropup">
                //     <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                //     <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                //         <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                //         <a href="edit_goal?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                //     </div>
                //     </div>' ;
                // }elseif($row->goal_status == "Approved"){
                //     $btn = '<div class="dropup">
                //     <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                //     <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                //         <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                //     </div>
                //     </div>' ;
                // }            
            
                $btn = '<div class="dropup">
                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                    <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                </div>
                </div>' ;

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
                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        <a href="goal_setting_supervisor_edit?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                    </div>
                    </div>' ;                                   
    
                return $btn;
            })
    
            ->rawColumns(['status', 'action'])
            ->make(true);
        }
        
    }
    public function get_reviewer_goal_list(Request $request){ 

        if ($request !="") {
            $input_details = array(
            'team_member_filter'=>$request->input('team_member_filter'),
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
                        <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        <a href="goal_setting_reviewer_edit?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
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
    public function fetch_team_leader_filter(Request $request){        
        $team_leader_filter = $request->team_leader_filter;
        $result = $this->goal->fetch_team_leader_filter($team_leader_filter); 
        return json_encode($result); 
    }
}
