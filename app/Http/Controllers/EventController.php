<?php

namespace App\Http\Controllers;

use App\Repositories\IEventRepositories;
use Illuminate\Http\Request;
use App\Event;
use App\EventAttendee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends Controller
{

    public $event;

    public function __construct(IEventRepositories $event)
    {
        $this->event = $event;

        // $this->middleware('backend_coordinator');
    }
   
    public function add_new_event_insert(Request $request)
    {
        $result = $request->validate([
            'event_name' => 'required', 
            'where' => 'required', 
            'description' => 'required', 
            // 'candicate_list_options[]' => 'required', 
            'start_date' => 'required', 
            'start_time' => 'required', 
            'end_date' => 'required', 
            'end_time' => 'required|different:start_time', 
        ]);

        if ($request->repeat) {
            $repeat = $request->repeat;
        } else {
            $repeat = 'no';
        }

        if($request->candicate_list){ //all candicates         

            $all_candicate_list = "yes";

        }elseif($request->candicate_list_options){
                                   
            $all_candicate_list = "no";

        }else{
            $all_candicate_list = "no";
        }

        $start_date_time = $request->start_date. ' ' .$request->start_time.':00';
        $end_date_time = $request->end_date. ' ' .$request->end_time.':00';
        // $end_date_time = Carbon::createFromFormat("d-m-Y", $request->end_date)->format('Y-m-d') . ' ' . Carbon::createFromFormat("h:i A", $request->end_time)->format('H:i:s');

        $data = array(
            'event_name' => $request->event_name,
            'label_color' => $request->label_color,
            'where' => $request->where,
            'description' => $request->description,
            'start_date_time' => $start_date_time,
            'end_date_time' => $end_date_time,
            'repeat' => $repeat,
            'repeat_every' => $request->repeat_count,
            'repeat_cycles' => $request->repeat_cycles,
            'repeat_type' => $request->repeat_type,
            'category_name' => $request->category_name,
            'event_type' => $request->event_type,
            'event_unique_code' => "",
            'candicate_list' => $all_candicate_list,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $last_inserted_id = $this->event->add_event_insert($data);

        if(!empty($last_inserted_id)){
            $event_code="E00";				
            $event_unique_code = $event_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->event->insertEventCode($event_unique_code, $last_inserted_id);           
        }        
      
        //Store event attendees
        // $eventIds [] = $last_inserted_id;

        // $offerData = [
        //     'name' => 'BOGO',
        //     'body' => 'You received an offer.',
        //     'thanks' => 'Thank you',
        //     'offerText' => 'Check out the offer',
        //     'offerUrl' => url('/'),
        //     'offer_id' => 007
        // ];

        if ($request->candicate_list) {
            $attendees = DB::table("candidate_details")->select('*')->get(); // get all the user list
            foreach ($attendees as $attendee) {
                EventAttendee::firstOrCreate(['candidate_name' => $attendee->candidate_name, 'event_id' => $last_inserted_id]);
            }

            // Notification::send($attendees, new OffersNotification($offerData));
        }

        // Select employees
        if ($request->candicate_list_options) {
            foreach ($request->candicate_list_options as $candicateName) {
                // dd($candicateName);
                EventAttendee::firstOrCreate(['candidate_name' => $candicateName, 'event_id' => $last_inserted_id]);
            }            
            // $attendees = DB::table("candidate_details")->whereIn('id', $request->candicate_list_options)->get(); // get all the user list
            // Notification::send($attendees, new EventInvite($event));
        }

        // if (!$request->has('repeat') || $request->repeat == 'no') {
        //     $event->event_id = $this->googleCalendarEvent($event);
        //     $event->save();
        // }


        return response($result);
        
    }

    public function fetch_all_event(Request $request)
    {


        // $eventFilter = DB::whereDate('event_start', '>=', $request->start)
        //     ->whereDate('event_end',   '<=', $request->end)
        //     ->get(['id', 'event_name', 'event_start', 'event_end']);
        
        // dd($request['custom_param1']);

        // if (request()->has('employee') && $request->employee != 0) {
        //     // $eventFilter->whereHas('attendee', function ($query)use($request) {
        //     //     return $query->where('user_id', $request->employee);
                   
        //     // });
        //     dd("yes");
        // }else{
        //     dd("no");
        // }

        $eventFilter = $this->event->fetch_event_filter();  

        $event_list = array();

        foreach ($eventFilter as $key => $value) {
            
            $event_list[] = [

                'id' => $value->id,
                'title' => $value->event_name,
                'color' => $value->label_color,
                'category_name' => $value->category_name,
                'start' => $value->start_date_time,
                'end' => $value->end_date_time,      
                                  
            ];

        }

        return $event_list;
               
    }

    public function fetch_event_edit(Request $request)
    {
        $id = $request['id'];
        $fetch_event_edit_list = $this->event->fetch_event_edit($id);  
        return response($fetch_event_edit_list);
        
    }

    public function event_delete(Request $request)
    {
        $id = $request['id'];
        $event_deleted = $this->event->event_delete($id);  
        return response($event_deleted);
        
    }
    

    public function fetch_event_attendees_list(Request $request)
    {
        $id = $request['id'];   
        $fetched = DB::table("candidate_details")->select('*')->get(); // get all the user list

        $output = '<option value="">Choose Member</option>';                       

        foreach ($fetched as $record) {  
           $fetch_selected = DB::table('event_attendees')
            ->where('candidate_name', $record->candidate_name)
            ->where('event_id', $id)
            ->get();

            if(count($fetch_selected) != 0){
                $output .= '<option value="'.$record->candidate_name.'" selected>'.$record->candidate_name.'</option>';                                                                                                      

            }
            else{
                $output .= '<option value="'.$record->candidate_name.'">'.$record->candidate_name.'</option>';                                                                                                      
            }	       
                        
        }    
               
		echo json_encode($output);
    }

    public function fetch_event_attendees_show(Request $request)
    {
        $id = $request['id'];   
                
        $fetched = DB::table('event_attendees')
        ->where('event_id', $id)
        ->get();

        $output = '';                       

        foreach ($fetched as $record) {  
                     
            $output .= '<img src="{{ asset("/img/default-profile-3.png") }}" data-toggle="tooltip"
            data-original-title="'.$record->candidate_name.'" data-placement="right"
            class="img-circle" width="25" height="25" alt="user">';                                                                                                      
         
        }    
               
		echo json_encode($output);
    }

    public function event_update(Request $request)
    {      
        $event_update_id = $request->event_update_id;

        if ($request->repeat) {
            $repeat = $request->repeat;
            $repeat_cycles = $request->repeat_cycles;
        } else {
            $repeat = 'no';
            $repeat_cycles = "";
        }

        if($request->candicate_list){ //all candicates
            
            $attendees = DB::table("candidate_details")->select('*')->get(); // get all the user list
            foreach ($attendees as $attendee) {
                $response = EventAttendee::where('event_id', $request->event_update_id)->delete();
                $response = EventAttendee::firstOrCreate(['candidate_name' => $attendee->candidate_name, 'event_id' => $request->event_update_id]);
            }

            $all_candicate_list = "yes";

        }elseif($request->candicate_list_options){
            
            // dd($$request->candicate_list_options);
            foreach ($request->candicate_list_options as $candicateName) {
                // dd($candicateName);
                $response = EventAttendee::where('event_id', $request->event_update_id)->delete();
                $response = EventAttendee::firstOrCreate(['candidate_name' => $candicateName, 'event_id' => $request->event_update_id]);
            }    

            // dd($response);
            // $json = json_encode($request->candicate_list_options);            
            $all_candicate_list = "no";
        }else{
            $all_candicate_list = "no";
        }

        $start_date_time = $request->start_date. ' ' .$request->start_time;
        $end_date_time = $request->end_date. ' ' .$request->end_time;
        // $end_date_time = Carbon::createFromFormat("d-m-Y", $request->end_date)->format('Y-m-d') . ' ' . Carbon::createFromFormat("h:i A", $request->end_time)->format('H:i:s');

        $data = array(
            'event_update_id' => $event_update_id,
            'event_name' => $request->event_name,
            'label_color' => $request->label_color,
            'where' => $request->where,
            'description' => $request->description,
            'start_date_time' => $start_date_time,
            'end_date_time' => $end_date_time,
            'repeat' => $repeat,
            'repeat_every' => $request->repeat_count,
            'repeat_cycles' => $request->repeat_cycles,
            'repeat_type' => $request->repeat_type,
            'category_name' => $request->category_name,
            'event_type' => $request->event_type,
            'candicate_list' => $all_candicate_list,
        );

        // dd($data);

        $result = $this->event->event_update($data);
        
        //Store event attendees
        // $eventIds [] = $last_inserted_id;

        // $offerData = [
        //     'name' => 'BOGO',
        //     'body' => 'You received an offer.',
        //     'thanks' => 'Thank you',
        //     'offerText' => 'Check out the offer',
        //     'offerUrl' => url('/'),
        //     'offer_id' => 007
        // ];

        // if ($request->candicate_list) {
        //     $attendees = DB::table("candidate_details")->select('*')->get(); // get all the user list
        //     foreach ($attendees as $attendee) {
        //         EventAttendee::firstOrCreate(['candidate_name' => $attendee->candidate_name, 'event_id' => "3"]);
        //     }

        //     // Notification::send($attendees, new OffersNotification($offerData));
        // }

        //Select employees
        // if ($request->candicate_list_options) {
        //     foreach ($request->candicate_list_options as $candicateName) {
        //         // dd($candicateName);
        //         EventAttendee::firstOrCreate(['candidate_name' => $candicateName, 'event_id' => "3"]);
        //     }            
        //     // $attendees = DB::table("candidate_details")->whereIn('id', $request->candicate_list_options)->get(); // get all the user list
        //     // Notification::send($attendees, new EventInvite($event));
        // }

        // if (!$request->has('repeat') || $request->repeat == 'no') {
        //     $event->event_id = $this->googleCalendarEvent($event);
        //     $event->save();
        // }


        return response($result);
        
    }
    
}
