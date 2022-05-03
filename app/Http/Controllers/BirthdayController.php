<?php

namespace App\Http\Controllers;

use App\Repositories\IHolidayRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BirthdayController extends Controller
{
    public function __construct(IHolidayRepository $holiday)
    {
        $this->middleware('is_admin');
        $this->holiday = $holiday;
    } 

    public function birthdays()
    {  
        $customusers = DB::table('customusers')
                     ->get();
        $data = [
            "customusers" => $customusers,        
        ];        
        return view('birthday.birthday')->with($data);
    }
    public function fetch_birthdays_list(Request $request)
    {        

        $current_month = date("m");
        $current_year = date("Y");

        if($request->employee != ""){
            // dd($request->employee);
            $birthdaysFilter = DB::table('customusers')->select('*')->where('empID', $request->employee)->get();        

        }else{
            // dd("null");
            $birthdaysFilter = DB::table('customusers')->select('*')->get();        

        }

        // $birthdaysFilter = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%%-'.$current_month.'-%%')->get();        
        // dd(count($birthdaysFilter));
        $birthdays_list = array();

        foreach ($birthdaysFilter as $key => $value) {
            
            $dob = $value->dob;            
            $dt = date("d", strtotime($dob));
            $month = date("m", strtotime($dob));
            $birthdays_date = $current_year."-".$month."-".$dt;

            $birthdays_list[] = [

                'id' => $value->id,
                'title' => $value->username,
                'empID' => $value->empID,
                'start' => $birthdays_date,                 
                'view' => $value->id              
                                  
            ];

        }

        return response($birthdays_list);

    }
    public function fetch_birthdays_list_date(Request $request)
    {
        $dt = $request['date'];
        $current_month = date("m", strtotime($dt));
        $current_year = date("Y", strtotime($dt));

        // $birthdaysFilter = DB::table('divya_sample')->select('*')->where('dob', 'LIKE', '%%-'.$current_month.'-%%')->get();

        $birthdaysFilter = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%%-'.$current_month.'%')->get();        
                 
        $birthdays_list = array();

        foreach ($birthdaysFilter as $key => $value) {
            
            $dob = $value->dob;            
            $dt = date("d", strtotime($dob));
            $month = date("m", strtotime($dob));
            $birthdays_date = $current_year."-".$month."-".$dt;

            $birthdays_list[] = [

                'id' => $value->id,
                'title' => $value->username,
                'empID' => $value->empID,
                'start' => $birthdays_date,                 
                'view' => $value->id              
                                  
            ];

        }

        return response($birthdays_list);    
    }
    public function fetch_birthdays_filter_user(Request $request)
    {
        $emp_id = $request['value'];

        $dt = $request['date'];
        $current_month = date("m", strtotime($dt));
        $current_year = date("Y", strtotime($dt));

        $birthdaysFilter = DB::table('customusers')->select('*')->where('empID', $emp_id)->get();        
                 
        $birthdays_list = array();

        foreach ($birthdaysFilter as $key => $value) {
            
            $dob = $value->dob;            
            $dt = date("d", strtotime($dob));
            $month = date("m", strtotime($dob));
            $birthdays_date = $current_year."-".$month."-".$dt;

            $birthdays_list[] = [

                'id' => $value->id,
                'title' => $value->username,
                'empID' => $value->empID,
                'start' => $birthdays_date,                 
                'view' => $value->id              
                                  
            ];

        }

        return response($birthdays_list);    
    }
    public function fetch_birthdays_list_empID(Request $request)
    {
        $empID = $request['empID'];
        $holidays_list = DB::table('customusers')
                    ->where('empID', $empID)
                    ->get();
        return response($holidays_list);               
    }

    

}
