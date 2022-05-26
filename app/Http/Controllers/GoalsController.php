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
        $result = $this->goal->checkCustomUserSuperList();
        if($result == "Yes"){
            return view('goals.sup_goal_index');

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
            // dd($cell2);

            $html .= '<tr  class="border-bottom-primary">';
            $html .= '<th scope="row">'.$cell1.'</th>';

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
        $row_count = count($request->all())/6;

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

        $logined_empID = Auth::user()->empID;        
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
                if($row->goal_status == "Pending" || $row->goal_status == "Revert"){
                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        <a href="edit_goal?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                    </div>
                    </div>' ;
                }elseif($row->goal_status == "Approved"){
                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    </div>
                    </div>' ;
                }            
            
            // <a class="dropdown-item ditem-gs deleteRecord"  data-id="'.$row->goal_unique_code.'"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>

            return $btn;
        })

        ->rawColumns(['action'])
        ->make(true);
        
    }
    public function get_team_member_goal_list(){

        $get_goal_list_result = $this->goal->get_team_member_goal_list();

        return DataTables::of($get_goal_list_result)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending" || $row->goal_status == "Revert"){
                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        <a href="edit_goal?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                    </div>
                    </div>' ;
                }elseif($row->goal_status == "Approved"){
                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    </div>
                    </div>' ;
                }            
            
            // <a class="dropdown-item ditem-gs deleteRecord"  data-id="'.$row->goal_unique_code.'"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>

            return $btn;
        })

        ->rawColumns(['action'])
        ->make(true);
        
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
        $row_count = $count/6;
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
}
