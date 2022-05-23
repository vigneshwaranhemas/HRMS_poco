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
        return view('goals.index');
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
    public function add_goals_data(Request $request)
    {
       
        
        // dd($request->all());die();

        $row_count = count($request->all())/6;
        // dd(count($request->input('sub_indicators_2')));die();
        // $i = 2;
        // dd($request->input('sub_indicators_'.$i.''));die();

        // $json = [];

        for ($i=1; $i <= $row_count; $i++) {

            // $json[] = array( //customised inputs
            //     "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
            //     "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
            //     "sub_indicators_$i" => $request->input('sub_indicators_'.$i.''),
            //     "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
            //     "weightage_$i" => $request->input('weightage_'.$i.''),
            //     "reference_$i" => $request->input('reference_'.$i.''),
            // );

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "sub_indicators_$i" => $request->input('sub_indicators_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "weightage_$i" => $request->input('weightage_'.$i.''),
                "reference_$i" => $request->input('reference_'.$i.''),
            ]);

            // $json[] = json_encode[ //customised inputs
            //     "key_bus_drivers_$i" : $request->input('key_bus_drivers_'.$i.''),
            //     "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
            //     "sub_indicators_$i" => $request->input('sub_indicators_'.$i.''),
            //     "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
            //     "weightage_$i" => $request->input('weightage_'.$i.''),
            //     "reference_$i" => $request->input('reference_'.$i.''),
            // ];

        }    

        $goal_process = json_encode($json); //convert to json
        // $json_stripslashes = stripslashes(json_encode($json)); //convert to json
        // dd($json_stripslashes);

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
            'goal_status' => "0",
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
                $btn = '<div class="dropup">
                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                    <a href="goal_setting" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-eye"></i></button></a>
                    <a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>
                </div>
            </div>' ;
            // <a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-pencil"></i></button></a>

            return $btn;
        })

        ->rawColumns(['action'])
        ->make(true);
        
    }
    
}
