<?php

namespace App\Http\Controllers;

use App\Repositories\IHolidayRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HolidayController extends Controller
{
    public function __construct(IHolidayRepository $holiday)
    {
        $this->middleware('is_admin');
        $this->holiday = $holiday;
    } 
    public function holidays()
    {
        return view('holidays.holidays');
    }
    public function add_new_holidays_insert(Request $request)
    {
        $result = $request->validate([
            'occassion' => 'required', 
        ]);

        $data = array(
            'occassion' => $request->occassion,
            'date' => $request->occassion_date,
            'description' => $request->description,
            'created_by' => "900386"
        );

        $result = $this->holiday->add_holidays_insert($data);

        return response($result);

    }
    public function fetch_holidays_list(Request $request)
    {
        $holidaysFilter = $this->holiday->fetch_holidays_list();  

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
        $data = array(
            'occassion' => $request->occassion,
            'description' => $request->description,
            'id' => $request->id,
        );

        $result = $this->holiday->holidays_update($data);        
        
        return response($result);
        
    }
    public function holidays_delete(Request $request)
    {
        $id = $request['id'];
        $holidays_delete = $this->holiday->holidays_delete($id);  
        return response($holidays_delete);
        
    }
    
}
