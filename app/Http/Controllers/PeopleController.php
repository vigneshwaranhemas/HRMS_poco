<?php

namespace App\Http\Controllers;
use App\Repositories\IPeopleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public $people;  

    // public function __construct()
    public function __construct(IPeopleRepository $people)
    {
        $this->middleware('is_admin');
        $this->people = $people;
    }
    public function people()
    {        
        $customusers = $this->people->fetch_customuser_list();  

        $departments = DB::table('departments')->get();
        $designations = DB::table('designations')->get();

       // echo json_encode($customusers[0]);die();
        $data = [
            "customusers" => $customusers,
            "departments" => $departments,
            "designations" => $designations,
        ];
        return view('people.index')->with($data);
    }
    public function fetch_people_list_filter(Request $request)
    {
        $employee = $request->input('employee');
        $customusers = $this->people->fetch_people_list_filter($employee); 
        return response($customusers);
    }
    public function fetch_people_starred_first_empid()
    {
        $emp_id = $this->people->fetch_people_starred_first_empid(); 
        return json_encode($emp_id);
    }
    public function fetch_people_everyone_first_empid()
    {
        $emp_id = $this->people->fetch_people_everyone_first_empid(); 
        return response($emp_id);
    }
    public function fetch_people_star_add(Request $request)
    {
        $emp_id = $request->input('emp_id');
        
        $people_star = $this->people->fetch_people_star_add($emp_id); 

        return response()->json( ['output' => $people_star] );
        // return response($people_star_added);
    }
    public function fetch_people_list_filter_star(Request $request)
    {
        $employee = $request->input('employee');
        $customusers = $this->people->fetch_people_list_filter_star($employee); 
        return json_encode($customusers);
    }
    public function fetch_starred_customusers_list(Request $request)
    {
        // if(!empty($request->all())){
            // dd("yes");
            $data = array(
                'people_filter_dept' => $request->people_filter_dept,
                'people_filter_design' => $request->people_filter_design,
            );
            $starred_customusers = $this->people->fetch_starred_customusers_list_with_filter($data);

        // }else{
        //     // dd("no");
        //     $starred_customusers = $this->people->fetch_starred_customusers_list();
        // }
        return json_encode($starred_customusers);
    }
    public function fetch_everyone_customusers_list(Request $request)
    {
        $data = array(
            'people_filter_dept' => $request->people_filter_dept,
            'people_filter_design' => $request->people_filter_design,
        );
        $starred_customusers = $this->people->fetch_everyone_customusers_list_with_filter($data);

        return json_encode($starred_customusers);
    }
}
