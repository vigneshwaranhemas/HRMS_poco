<?php

namespace App\Http\Controllers;

use App\Repositories\IAdminRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Auth;
use Session;

class AdminController extends Controller
{
    public function __construct(IAdminRepository $admrpy)
    {
        $this->middleware('is_admin');
        $this->admrpy = $admrpy;
    }

    public function admin_dashboard()
    {
        //Birthday card
        $current_date = date("d-m-Y");
        $date = Carbon::createFromFormat('d-m-Y', $current_date);
        $result = $date->format('F');
        $monthName = substr($result, 0, 3);
        $dt = $date->format('d');
        $tdy = $dt."-".$monthName;
        $todays_birthdays = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%'.$tdy.'%')->get();

        //Work anniversary
        $tdy_work_anniversary = DB::table('customusers')->select('*')->where('doj', 'LIKE', '%'.$tdy.'%')->get();

        //Upcoming holidays
        $upcoming_holidays = DB::table('holidays')->select('*')->where('date', '>=', $date)->limit(2)->get();

        //Upcoming events
        $upcoming_events = DB::table('events')->select('*')->where('start_date_time', '>=', $date)->limit(2)->get();

        $data = [
            "todays_birthdays" => $todays_birthdays,
            "tdy_work_anniversary" => $tdy_work_anniversary,
            "upcoming_holidays" => $upcoming_holidays,
            "upcoming_events" => $upcoming_events,
        ];

        return view('admin.dashboard')->with($data);
    }
    public function admin_goals()
    {
        return view('admin.goals');
    }
    public function admin_add_goal_setting()
    {
        return view('admin.add_goal_setting');
    }
    public function admin_goal_setting()
    {
        return view('admin.goal_setting');
    }
    public function holidays()
    {
        return view('admin.holidays');
    }
    public function events()
    {
        $candicate_details = DB::table('candidate_details')->get();
        $event_categories_data = DB::table('event_categories')->get();
        $event_types_data = DB::table('event_types')->get();
        return view('event-calendar.index', ['candicate_details'=> $candicate_details, 'event_categories_data'=> $event_categories_data, 'event_types_data'=> $event_types_data]);
    }
    public function Hr_SeatingRequest()
    {
         $status=0;
         $seating_info=$this->admrpy->get_seating_requested($status);
         return view('admin.SeatingRequest')->with('seating_info',$seating_info);
    }
    public function permission()
    {
        return view('admin.permission');
    }
    public function com_dashboard()
    {
        $current_date = date("d-m-Y");
        $date = Carbon::createFromFormat('d-m-Y', $current_date);
        $result = $date->format('F');
        $monthName = substr($result, 0, 3);
        $dt = $date->format('d');
        $tdy = $dt."-".$monthName;
        $todays_birthdays = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%'.$tdy.'%')->get();

        //Work anniversary
        $tdy_work_anniversary = DB::table('customusers')->select('*')->where('doj', 'LIKE', '%'.$tdy.'%')->get();

        //Upcoming holidays
        $upcoming_holidays = DB::table('holidays')->select('*')->where('date', '>=', $date)->limit(2)->get();

        //Upcoming events
        $logined_empid = Auth::user()->empID;
        $upcoming_events = DB::table('event_attendees')
                     ->distinct()
                     ->select('events.*')
                     ->join('events', 'event_attendees.event_id', '=', 'events.event_unique_code')
                     ->where('events.start_date_time', '>=', $date)
                     ->where('event_attendees.candidate_name', $logined_empid)
                     ->limit(2)
                     ->get();

        // dd($upcoming_events);

        // $upcoming_events = DB::table('events')->select('*')->where('start_date_time', '>=', $date)->limit(2)->get();

        $data = [
            "todays_birthdays" => $todays_birthdays,
            "tdy_work_anniversary" => $tdy_work_anniversary,
            "upcoming_holidays" => $upcoming_holidays,
            "upcoming_events" => $upcoming_events,
        ];
        return view('com_dashboard')->with($data);
    }
    /* role List */
    public function role_list(){
        $get_menu_list_result = $this->admrpy->get_role_list_base( );
        return response()->json( $get_menu_list_result );
    }
    /*menu listing */
    public function menu_listing(Request $req){
        $role_id['role_id'] = $req->role_id;

        $get_menu_result = $this->admrpy->get_menu_list_res($role_id);
         // echo "<pre>";print_r($get_menu_result);die();
        return response()->json( $get_menu_result );
    }
    /*save a menu and sub-menu*/
    public function sub_menu_save_tab(Request $req){

      $data=$req->selected;

        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];
        $cdID = $session_val['cdID'];

        $user = DB::table( 'role_permissions' )->where('role', '=', $data[0]['role'])->first();

         if ($user === null) {
          foreach ($data as $key => $value) {
             $res_array[]=array("empID"=>$empID,
                                "cdID"=>$cdID,
                                "role"=>$value['role'],
                                "menu"=>$value['menu'],
                               "sub_menu"=>$value['sub_menu'],
                               "view"=>$value['view'],
                               "update"=>$value['update'],
                               "add"=>$value['add'],
                               "delete"=>$value['delete'],);
                        }
                  // echo "<pre>";print_r($res_array);die();
            $get_menu_result = $this->admrpy->get_submenu_save_res( $res_array);
        }else{
            foreach ($data as $key => $value) {
                // echo "<pre>";print_r($data);die();
                $res_array[]=array("empID"=>$empID,
                                "cdID"=>$cdID,
                                "colid"=>$value['colid'],
                                "role"=>$value['role'],
                                "menu"=>$value['menu'],
                               "sub_menu"=>$value['sub_menu'],
                               "view"=>$value['view'],
                               "update"=>$value['update'],
                               "add"=>$value['add'],
                               "delete"=>$value['delete'],);
                        }
            $get_menu_result = $this->admrpy->get_submenu_update_res( $res_array);
        }

        return response()->json( $data );
    }

    public function business()
    {
        return view('admin.masters.business');
    }
    public function employee_list()
    {
        return view('admin.masters.employee_list');
    }

    public function division()
    {
        return view('admin.masters.division');
    }
    public function function()
    {
        return view('admin.masters.function');
    }
    public function grade()
    {
        return view('admin.masters.grade');
    }
    public function band()
    {
        return view('admin.masters.band');
    }
    public function location()
    {
        return view('admin.masters.location');
    }
    public function blood()
    {
        return view('admin.masters.blood');
    }
    public function roll()
    {
        return view('admin.masters.roll');
    }
    public function department()
    {
        return view('admin.masters.department');
    }
    public function designation_or_position()
    {
        return view('admin.masters.designation_or_position');
    }
    public function client()
    {
        return view('admin.masters.client');
    }
    public function state()
    {
        return view('admin.masters.state');
    }
    public function zone()
    {
        return view('admin.masters.zone');
    }
    public function personnel()
    {
        return view('admin.masters.personnel');
    }
    public function user()
    {
        return view('admin.users');
    }
    public function roles()
    {
        return view('admin.masters.add_roles');
    }
    public function roles_s()
    {
        return view('admin.roll_s');
    }

    // Business Process Start
    public function add_business_unit(Request $req)
    {

        $data = $req->validate([
            'business_name' => 'required',
            ]);

        $bu_id = 'BU'.((DB::table( 'business_unit' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');

        $form_data = array(
            'bu_id' => $bu_id,
            'business_name' => $req->input('business_name'),
            'status' => "active",
            'created_on' => $today_date,
            'created_by' => '900315'

        );

        $add_business_unit_process_result = $this->admrpy->add_business_unit_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_business_unit_database(Request $request)
    {
        if ($request->ajax()) {

            $get_business_unit_database_result = $this->admrpy->get_business_unit_database_data( );


        return DataTables::of($get_business_unit_database_result)
        ->addIndexColumn()


        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "active")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "Inactive"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

            if($row->status == "active")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="business_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=business_status_process('."'".$row->id."'".',"Inactive");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="business_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';

                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="business_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=business_status_process('."'".$row->id."'".',"active");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="business_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('business');
    }

    public function get_employee_list(Request $request)
    {
        if ($request->ajax()) {

            $get_employee_list_result = $this->admrpy->get_employee_list();


            return DataTables::of($get_employee_list_result)
            ->addIndexColumn()
            // ->addColumn('status', function($row) {
            //     $btn = '';
            //     $result =  $row->status;
            //     // print_r($result);
            //     // die();
            //     if($result == "active")
            //     {
            //         $btn = '<span class="badge badge-success">Active</span>';
            //     }elseif($result == "Inactive"){
            //         $btn = '<span class="badge badge-warning">Inactive</span>';
            //     }

            //     return $btn;
            // })

            // ->addColumn('action', function($row) {
            //     $candidate_profile = "candidate_profile";
            //     $btn = '<a href="candidate_profile"><i class="fa fa-edit"></i><a>';
            //     return $btn;
            // })
            // ->rawColumns(['action'])
            ->make(true);
        }

    }

    public function get_business_unit_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_business_unit_details_result = $this->admrpy->get_business_unit_details( $input_details );

        return response()->json( $get_business_unit_details_result );
    }

    public function update_business_unit_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'business_name'=>$req->input('business_name'),
        );

        $update_business_unit_details_result = $this->admrpy->update_business_unit_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_business_unit_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),
        );

        $process_business_unit_status_result = $this->admrpy->process_business_unit_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_business_unit_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_business_unit_delete_result = $this->admrpy->process_business_unit_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Business Process End

    // Division Process Start
    public function add_division_unit_process(Request $req)
    {
        $data = $req->validate([
            'division_name' => 'required',
            ]);

        $d_id = 'D'.((DB::table( 'divisions' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'd_id' => $d_id,
            'division_name' => $req->input('division_name'),
            'status' => "active",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        // echo '<pre>';print_r($form_data);
        // die;
        $add_division_unit_process_result = $this->admrpy->add_division_unit_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_division_unit_database(Request $request)
    {
        if ($request->ajax()) {

            $get_division_unit_database_result = $this->admrpy->get_division_unit_database_data( );


        return DataTables::of($get_division_unit_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "active")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "Inactive"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "active")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="division_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=division_status_process('."'".$row->id."'".',"Inactive");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="division_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';


                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="division_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=division_status_process('."'".$row->id."'".',"active");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="division_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['status','action'])
        ->make(true);
        }
        return view('division');
    }

    public function get_division_unit_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_division_unit_details_result = $this->admrpy->get_division_unit_details( $input_details );

        return response()->json( $get_division_unit_details_result );
    }

    public function update_division_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'division_name'=>$req->input('division_name'),
        );

        $update_division_details_result = $this->admrpy->update_division_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_division_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_division_status_result = $this->admrpy->process_division_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_division_unit_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_division_unit_delete_result = $this->admrpy->process_division_unit_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Division Process End

    // Function Process Start
    public function add_function_process(Request $req)
    {
        $data = $req->validate([
            'function_name' => 'required',
            ]);

        $f_id = 'F'.((DB::table( 'function_masters' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'f_id' => $f_id,
            'function_name' => $req->input('function_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        // echo '<pre>';print_r($form_data);
        // die;
        $add_function_process_result = $this->admrpy->add_function_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_function_database(Request $request)
    {
        if ($request->ajax()) {

            $get_function_database_result = $this->admrpy->get_function_database_data( );


        return DataTables::of($get_function_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="function_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=function_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="function_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="function_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=function_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="function_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('function');
    }

    public function get_function_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_function_details_result = $this->admrpy->get_function_details( $input_details );

        return response()->json( $get_function_details_result );
    }

    public function update_function_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'function_name'=>$req->input('function_name'),
        );

        $update_function_details_result = $this->admrpy->update_function_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_function_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),
        );

        $process_function_status_result = $this->admrpy->process_function_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_function_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_function_delete_result = $this->admrpy->process_function_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Function Process End

    // Grade Process Start
    public function add_grade_process(Request $req)
    {
        $data = $req->validate([
            'grade_name' => 'required',
            ]);

        $g_id = 'G'.((DB::table( 'grades' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'g_id' => $g_id,
            'grade_name' => $req->input('grade_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_grade_process_result = $this->admrpy->add_grade_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_grade_database(Request $request)
    {
        if ($request->ajax()) {

            $get_grade_database_result = $this->admrpy->get_grade_database_data( );


        return DataTables::of($get_grade_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="grade_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=grade_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="grade_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="grade_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=grade_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="grade_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('grade');
    }

    public function get_grade_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_grade_details_result = $this->admrpy->get_grade_details( $input_details );

        return response()->json( $get_grade_details_result );
    }

    public function update_grade_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'grade_name'=>$req->input('grade_name'),
        );

        $update_grade_details_result = $this->admrpy->update_grade_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_grade_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_grade_status_result = $this->admrpy->process_grade_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_grade_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_grade_delete_result = $this->admrpy->process_grade_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Grade Process End

    // Location Process Start
    public function add_location_process(Request $req)
    {
        $data = $req->validate([
            'location_name' => 'required',
            ]);

        $l_id = 'L'.((DB::table( 'locations' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'l_id' => $l_id,
            'location_name' => $req->input('location_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_location_process_result = $this->admrpy->add_location_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_location_database(Request $request)
    {
        if ($request->ajax()) {

            $get_location_database_result = $this->admrpy->get_location_database_data( );


        return DataTables::of($get_location_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="location_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=location_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="location_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="location_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=location_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="location_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('location');
    }

    public function get_location_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_location_details_result = $this->admrpy->get_location_details( $input_details );

        return response()->json( $get_location_details_result );
    }

    public function update_location_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'location_name'=>$req->input('location_name'),
        );

        $update_location_details_result = $this->admrpy->update_location_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_location_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_location_status_result = $this->admrpy->process_location_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_location_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_location_delete_result = $this->admrpy->process_location_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Location Process End

    // Blood Process Start
    public function add_blood_process(Request $req)
    {
        $data = $req->validate([
            'blood_group_name' => 'required',
            ]);

        $bg_id = 'BG'.((DB::table( 'blood_groups' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'bg_id' => $bg_id,
            'blood_group_name' => $req->input('blood_group_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_blood_process_result = $this->admrpy->add_blood_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_blood_database(Request $request)
    {
        if ($request->ajax()) {

            $get_blood_database_result = $this->admrpy->get_blood_database_data( );


        return DataTables::of($get_blood_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="blood_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=blood_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="blood_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="blood_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=blood_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="blood_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('blood');
    }

    public function get_blood_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_blood_details_result = $this->admrpy->get_blood_details( $input_details );

        return response()->json( $get_blood_details_result );
    }

    public function update_blood_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'blood_group_name'=>$req->input('blood_group_name'),
        );

        $update_blood_details_result = $this->admrpy->update_blood_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_blood_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_blood_status_result = $this->admrpy->process_blood_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_blood_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_blood_delete_result = $this->admrpy->process_blood_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Blood Group Process End

    // Roll Process Start
    public function add_roll_process(Request $req)
    {
        $data = $req->validate([
            'roll_name' => 'required',
            ]);

        $r_id = 'R'.((DB::table( 'rolls' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'r_id' => $r_id,
            'roll_name' => $req->input('roll_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_roll_process_result = $this->admrpy->add_roll_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_roll_database(Request $request)
    {
        if ($request->ajax()) {

            $get_roll_database_result = $this->admrpy->get_roll_database_data( );


        return DataTables::of($get_roll_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="roll_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=roll_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="roll_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="roll_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=roll_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="roll_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('roll');
    }

    public function get_roll_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_roll_details_result = $this->admrpy->get_roll_details( $input_details );

        return response()->json( $get_roll_details_result );
    }

    public function update_roll_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'roll_name'=>$req->input('roll_name'),
        );

        $update_roll_details_result = $this->admrpy->update_roll_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_roll_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_roll_status_result = $this->admrpy->process_roll_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_roll_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_roll_delete_result = $this->admrpy->process_roll_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Roll Process End

    // Department Process Start
    public function add_department_process(Request $req)
    {
        $data = $req->validate([
            'department_name' => 'required',
            ]);

        $d_id = 'D'.((DB::table( 'departments' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'd_id' => $d_id,
            'department_name' => $req->input('department_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_department_process_result = $this->admrpy->add_department_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_department_database(Request $request)
    {
        if ($request->ajax()) {

            $get_department_database_result = $this->admrpy->get_department_database_data( );


        return DataTables::of($get_department_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="department_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=department_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="department_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="department_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=department_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="department_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('department');
    }

    public function get_department_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_department_details_result = $this->admrpy->get_department_details( $input_details );

        return response()->json( $get_department_details_result );
    }

    public function update_department_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'department_name'=>$req->input('department_name'),
        );

        $update_department_details_result = $this->admrpy->update_department_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_department_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_department_status_result = $this->admrpy->process_department_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_department_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_department_delete_result = $this->admrpy->process_department_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Department Process End

    // Designation Process Start
    public function add_designation_process(Request $req)
    {
        $data = $req->validate([
            'designation_name' => 'required',
            ]);

        $dg_id = 'DG'.((DB::table( 'designations' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'dg_id' => $dg_id,
            'designation_name' => $req->input('designation_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_designation_process_result = $this->admrpy->add_designation_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_designation_database(Request $request)
    {
        if ($request->ajax()) {

            $get_designation_database_result = $this->admrpy->get_designation_database_data( );


        return DataTables::of($get_designation_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {


        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="designation_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=designation_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="designation_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="designation_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=designation_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="designation_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('designation_or_position');
    }

    public function get_designation_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_designation_details_result = $this->admrpy->get_designation_details( $input_details );

        return response()->json( $get_designation_details_result );
    }

    public function update_designation_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'designation_name'=>$req->input('designation_name'),
        );

        $update_designation_details_result = $this->admrpy->update_designation_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_designation_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_designation_status_result = $this->admrpy->process_designation_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_designation_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_designation_delete_result = $this->admrpy->process_designation_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Designation Process End

    // State Process Start
    public function add_state_process(Request $req)
    {
        $data = $req->validate([
            'state_name' => 'required',
            ]);

        $s_id = 'S'.((DB::table( 'states' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            's_id' => $s_id,
            'state_name' => $req->input('state_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_state_process_result = $this->admrpy->add_state_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_state_database(Request $request)
    {
        if ($request->ajax()) {

            $get_state_database_result = $this->admrpy->get_state_database_data( );


        return DataTables::of($get_state_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="state_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=state_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="state_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="state_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=state_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="state_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('state');
    }

    public function get_state_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_state_details_result = $this->admrpy->get_state_details( $input_details );

        return response()->json( $get_state_details_result );
    }

    public function update_state_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'state_name'=>$req->input('state_name'),
        );

        $update_state_details_result = $this->admrpy->update_state_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_state_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_state_status_result = $this->admrpy->process_state_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_state_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_state_delete_result = $this->admrpy->process_state_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Designation Process End

    // Zone Process Start
    public function add_zone_process(Request $req)
    {
        $data = $req->validate([
            'zone_name' => 'required',
            ]);

        $z_id = 'Z'.((DB::table( 'zones' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'z_id' => $z_id,
            'zone_name' => $req->input('zone_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_zone_process_result = $this->admrpy->add_zone_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_zone_database(Request $request)
    {
        if ($request->ajax()) {

            $get_zone_database_result = $this->admrpy->get_zone_database_data( );


        return DataTables::of($get_zone_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="zone_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=zone_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="zone_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="zone_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=zone_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="zone_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('zone');
    }

    public function get_zone_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_zone_details_result = $this->admrpy->get_zone_details( $input_details );

        return response()->json( $get_zone_details_result );
    }

    public function update_zone_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'zone_name'=>$req->input('zone_name'),
        );

        $update_zone_details_result = $this->admrpy->update_zone_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_zone_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_zone_status_result = $this->admrpy->process_zone_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_zone_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_zone_delete_result = $this->admrpy->process_zone_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Zone Process End

    // Band Process Start
    public function add_band_process(Request $req)
    {
        $data = $req->validate([
            'band_name' => 'required',
            ]);

        $bn_id = 'BN'.((DB::table( 'bands' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'bn_id' => $bn_id,
            'band_name' => $req->input('band_name'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_band_process_result = $this->admrpy->add_band_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_band_database(Request $request)
    {
        if ($request->ajax()) {

            $get_band_database_result = $this->admrpy->get_band_database_data( );


        return DataTables::of($get_band_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="band_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=band_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="band_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="band_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=band_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="band_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('band');
    }

    public function get_band_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_band_details_result = $this->admrpy->get_band_details( $input_details );

        return response()->json( $get_band_details_result );
    }

    public function update_band_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'band_name'=>$req->input('band_name'),
        );

        $update_band_details_result = $this->admrpy->update_band_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_band_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_band_status_result = $this->admrpy->process_band_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_band_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_band_delete_result = $this->admrpy->process_band_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Band Process End

    // Client Process Start
    public function add_client_process(Request $req)
    {
        $data = $req->validate([
            'client_name' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            ]);

        $cl_id = 'CL'.((DB::table( 'clients' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'cl_id' => $cl_id,
            'client_name' => $req->input('client_name'),
            'mobile_number' => $req->input('mobile_number'),
            'email' => $req->input('email'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        $add_client_process_result = $this->admrpy->add_client_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_client_database(Request $request)
    {
        if ($request->ajax()) {

            $get_client_database_result = $this->admrpy->get_client_database_data( );


        return DataTables::of($get_client_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="client_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=client_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="client_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="client_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=client_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="client_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('client');
    }

    public function get_client_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_client_details_result = $this->admrpy->get_client_details( $input_details );

        return response()->json( $get_client_details_result );
    }

    public function update_client_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'client_name'=>$req->input('client_name'),
            'mobile_number'=>$req->input('mobile_number'),
            'email'=>$req->input('email'),
        );

        $update_client_details_result = $this->admrpy->update_client_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_client_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_client_status_result = $this->admrpy->process_client_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_client_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_client_delete_result = $this->admrpy->process_client_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Client Process End

    //image upload
    /*public function storeImage(Request $request)
    {
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];

        $folderPath = public_path('uploads\profile_image');
        // echo "<pre>";print_r($folderPath);
        $this->validate($request, ['picture' => 'mimes:jpeg,png,jpg|max:2048']);
        $picturename = date('mdYHis').uniqid().$request->file('image')->getClientOriginalName();

         $destinationPath =public_path("/uploads");
         $public_path_upload = $request->image->move($destinationPath,$picturename);

        $data =array(
            'name'=>$emp_ID,
            'path'=>$picturename,);
        $insert = DB::table( 'images' )->insert( $data );


    }*/

    public function storeImage(Request $request)
    {
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $cdID = $session_val['cdID'];

        $folderPath = public_path('uploads/');
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';


        $imageFullPath = $folderPath.$imageName;


        file_put_contents($imageFullPath, $image_base64);
        $user = DB::table( 'images' )->where('emp_id', '=', $emp_ID)->first();

        if ($user === null) {
            $data =array(
            'emp_id'=>$emp_ID,
            'cdID'=>$cdID,
            'path'=>$imageName);
        $insert = DB::table( 'images' )->insert( $data );
        return response()->json(['success'=>'insert']);
        }else{
            $data =array(
            'emp_id'=>$emp_ID,
            'cdID'=>$cdID,
            'path'=>$imageName,);
            $update_role_unit_details_result = $this->admrpy->update_profile_details( $data );
            return response()->json( ['success'=>'update'] );
        }
    }

    /*PreviewImage */
    public function PreviewImage(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        // echo "<pre>";print_r($emp_ID);die;
        $input_details = array( "cdID" => $cdID, );
        $get_profile_info_result = $this->admrpy->get_profile_info( $input_details );

        return response()->json( $get_profile_info_result );

        // return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }

     /* insert roles*/
    public function add_roles_process(Request $req)
    {

        $bu_id = 'RO'.((DB::table( 'roles' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'role_id' => $bu_id,
            'name' => $req->input('role_name'),
            'status' => "active",
            'created_on' => $today_date,
            'created_by' => '900315'

        );
        // echo '<pre>';print_r($form_data); die;
        $add_business_unit_process_result = $this->admrpy->add_role_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    /*role view*/
    public function get_role_data(Request $request)
    {
        if ($request->ajax()) {

            $get_role_data_result = $this->admrpy->get_role_data( );


        return DataTables::of($get_role_data_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result); die();
            if($result == "active")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "Inactive"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

            /*$btn = '<div class="btn-group dropdown m-r-10">
            <button aria-expanded="false" data-toggle="dropdown"
                class="btn btn-default dropdown-toggle waves-effect waves-light"
                type="button"><i class="fa fa-gears "></i></button>
            <ul role="menu" class="dropdown-menu pull-right">
                <li><a href="javascript:;" onclick="role_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
            </ul></div>';*/
            $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="role_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    </div>';
            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('add_roles');
    }

     public function update_role_unit_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'name'=>$req->input('role_name_edit'),
            'status'=>$req->input('role_status_edit'),
        );
        // echo "<pre>";print_r($input_details);die;
        $update_role_unit_details_result = $this->admrpy->update_role_unit_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function get_role_details_pop(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_role_details_result = $this->admrpy->get_role_details_pop( $input_details );

        return response()->json( $get_role_details_result );
    }

    public function masters() {
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        // echo "<pre>";print_r($emp_ID);die;
         $emp_ID = array( "emp_ID" => $emp_ID, );


        //business
        $business = $this->admrpy->get_table('tbl_business', $emp_ID);
        $data['business'] = $business;
        //band
        $band = $this->admrpy->get_table('tbl_band', $emp_ID);
        $data['band'] = $band;
        //work_location
        $work_location = $this->admrpy->get_table('tbl_work_location', $emp_ID);
        $data['work_location'] = $work_location;
        //blood_group
        $blood_group = $this->admrpy->get_table('tbl_blood_group', $emp_ID);
        $data['blood_group'] = $blood_group;
        //roll_intake
        $roll_intake = $this->admrpy->get_table('tbl_roll_intake', $emp_ID);
        $data['roll_intake'] = $roll_intake;
        //Manager
        $manager = $this->admrpy->get_table('tbl_personnel', $emp_ID);
        $data['manager'] = $manager;
        //Department
        $department = $this->admrpy->get_table('tbl_department', $emp_ID);
        $data['department'] = $department;
        //State
        $state = $this->admrpy->get_table('tbl_state', $emp_ID);
        $data['state'] = $state;
        //spoc s&d
        $users = $this->admrpy->get_table('users', $emp_ID);
        $data['users'] = $users;

        return response()->json( $data );

        // $this->load->view('admin/masters', $data);

    }





    //vignesh code starts here
    //admin Seating Request

    public function Admin_Seating_Allotment(Request $request)
    {
        $id=$request->id;
        $status=$request->status;
        if($status==1){
             $update_data=array('Seating_Request'=>1);
        }
        else{
             $update_data=array('IdCard_status'=>1);
        }
        $response=$this->admrpy->update_seating_status($id,$update_data);
        if($response){
            $result=array('success'=>1,'Message'=>"Status Updated Successfully");
        }
        else{
            $result=array('success'=>1,'Message'=>"Problem in Allot Seating For this Candidate");
        }
        echo json_encode($result);
    }



      //admin seating status update


       public function Seating_Status_update(Request $request)
       {
            $data=$request->empID;
            $update_data=array('status'=>1);
            $result=$this->admrpy->update_candidate_seating_status($data,$update_data);
            if($result)
            {
               $response=array('success'=>1,'message'=>"Status Updated Successfully");
            }
            else{
               $response=array('success'=>2,'message'=>"Problem in Updating Status");
            }
            echo json_encode($response);
         }



}
