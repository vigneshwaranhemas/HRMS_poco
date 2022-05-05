<?php

namespace App\Http\Controllers;

use App\Repositories\IHolidayRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class HolidayController extends Controller
{
    public function __construct(IHolidayRepository $holiday)
    {
        $this->middleware('is_admin');
        $this->holiday = $holiday;
    } 
    public function holidays()
    {
        $stateList = $this->holiday->fetch_state_list();  

        $data = [
            "stateList" => $stateList,
        ];

        return view('holidays.holidays')->with($data);
    }
    public function add_new_holidays_insert(Request $request)
    {        
        if($request->occassion_file != "undefined"){
            $result = $request->validate([
                'occassion' => 'required', 
                'occassion_file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                'state' => 'required', 
            ]);
        }else{
            $result = $request->validate([
                'occassion' => 'required', 
                'state' => 'required', 
            ]);
        }
        
        //File upload
        $file = $request->file('occassion_file');
        if($file){
            $name = $request->file('occassion_file')->getClientOriginalName();
            $public_path_upload = $request->occassion_file->move(public_path('holidays_file'), $name);                     
        }else {
            $name = "";
        }

        $created_by =Auth::user()->empID;

        //Data upload to server
        $data = array(
            'occassion' => $request->occassion,
            'date' => $request->occassion_date,
            'description' => $request->description,
            'occassion_file' => $name,
            'created_by' => $created_by
        );

        $last_inserted_id = $this->holiday->add_holidays_insert($data);        
        
        //Holiday code
        if(!empty($last_inserted_id)){
            $holiday_code="H";				
            $holiday_unique_code = $holiday_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->event->insertHolidayCode($holiday_unique_code, $last_inserted_id);           
        }     

        //State upload
        if($request->state){
            foreach ($request->states as $state) {
                // dd($state);
                $result = HolidayState::firstOrCreate(['state_name' => $state, 'holiday_code' => $event_unique_code]);
            }              
        }

        return response($result);

    }
    public function fetch_holidays_list(Request $request)
    {
        if(!empty($request->input('state'))){
            $state = $request->input('state');
            $holidaysFilter = $this->holiday->fetch_holidays_state_filter($state);  
        }else{
            $holidaysFilter = $this->holiday->fetch_holidays_list();  
        }
        
        $holidays_list = array();

        foreach ($holidaysFilter as $key => $value) {
            
            $holidays_list[] = [

                'id' => $value->id,
                'title' => $value->occassion,
                'start' => $value->date,                 
                'view' => $value->id                  
                // 'start' => "2022-04-03 00:00:00",                 
                // 'end' => "2022-04-03 00:00:00",                 
                                  
            ];

        }

        return response($holidays_list);
               
    }
    public function fetch_holidays_list_id(Request $request)
    {

        $id = $request['id'];
        $holidays_list = $this->holiday->fetch_holidays_list_id($id);          
        return response($holidays_list);               
    }
    public function fetch_holidays_state_id(Request $request)
    {
        $id = $request['id'];
        $holidays_state_list = $this->holiday->fetch_holidays_state_id($id);     
        return json_encode($holidays_state_list);               
    }
    public function fetch_holidays_list_date(Request $request)
    {
        $dt = $request['date'];
        $monthName = substr($dt, 0, 3);
        $yr = substr($dt, -4); 

        if($monthName == "Jan"){
            $month = "01";
        }elseif($monthName == "Feb"){
            $month = "02";
        }elseif($monthName == "Mar"){
            $month = "03";
        }elseif($monthName == "Apr"){
            $month = "04";
        }elseif($monthName == "May"){
            $month = "05";
        }elseif($monthName == "Jun"){
            $month = "06";
        }elseif($monthName == "Jul"){
            $month = "07";
        }elseif($monthName == "Aug"){
            $month = "08";
        }elseif($monthName == "Sep"){
            $month = "09";
        }elseif($monthName == "Oct"){
            $month = "10";
        }elseif($monthName == "Nov"){
            $month = "11";
        }elseif($monthName == "Dec"){
            $month = "12";
        }
        
        $filter_date = $yr."-".$month;
        $filter_date = $this->holiday->fetch_holidays_list_date($filter_date);          
        return response($filter_date);               
    }
    public function holidays_update(Request $request)
    {      
        //File upload
        $file = $request->file('occassion_file');

        if($file){
            //Got new file
            $name = $request->file('occassion_file')->getClientOriginalName();
            $public_path_upload = $request->occassion_file->move(public_path('holidays_file'), $name);                     

            $data = array(
                'occassion' => $request->occassion,
                'description' => $request->description,
                'state' => $request->state,
                'occassion_file' => $name,
                'id' => $request->id,
            );
            
            $result = $this->holiday->holidays_update_file($data);        


        }else {

            //No file update
            $data = array(
                'occassion' => $request->occassion,
                'description' => $request->description,
                'state' => $request->state,
                'id' => $request->id,
            );

            $result = $this->holiday->holidays_update($data);        


        }                

        
        return response($result);
        
    }
    public function holidays_delete(Request $request)
    {
        $id = $request['id'];
        $holidays_delete = $this->holiday->holidays_delete($id);  
        return response($holidays_delete);
        
    }
    
}
