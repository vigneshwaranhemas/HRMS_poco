<?php

namespace App\Http\Controllers;
use App\Repositories\IHrPreonboardingrepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class ItInfraController extends Controller
{
    public function __construct(IHrPreonboardingrepositories $hpreon)
    {
        $this->hpreon = $hpreon;
        $this->middleware('is_admin');
    }
    public function index()
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
        $logined_empid = Auth::user()->empID;
        $upcoming_events = DB::table('event_attendees')
                     ->distinct()
                     ->select('events.*')
                     ->join('events', 'event_attendees.event_id', '=', 'events.event_unique_code')
                     ->where('events.start_date_time', '>=', $date)
                     ->where('event_attendees.candidate_name', $logined_empid)
                     ->limit(2)
                     ->get();

        $data = [
            "todays_birthdays" => $todays_birthdays,
            "tdy_work_anniversary" => $tdy_work_anniversary,
            "upcoming_holidays" => $upcoming_holidays,
            "upcoming_events" => $upcoming_events,
        ];

        return view('ItInfra.dashboard')->with($data);
      }

    public function EmailIdCreation()
    {
        $status=1;
        $email_info['pending']=$this->hpreon->get_hrRequested_info($status);
        $status=2;
        $email_info['completed']=$this->hpreon->get_hrRequested_info($status);
        // $email_info=$this->hpreon->get_hrRequested_info();
        //   echo json_encode($email_info);
          return view('ItInfra.EmailIdCreation')->with('email_info',$email_info);
    }

    public function ITInfra_Email_Creation(Request $request)
    {
          $email_updation=$this->hpreon->update_itInfra_EmailStatus($request->empID);
          return $email_updation;
    }


}
