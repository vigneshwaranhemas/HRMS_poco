<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Event;
use Auth;

class EventRepositories implements IEventRepositories {
    
   public function add_event_insert($data)
   {
      $response = Event::insertGetId($data);        
      return $response;
   }
   public function fetch_category_details_all()
   {      
      $response = DB::table("candidate_details")->select('*')
                        ->get();
      return $response;
   }
   public function insertEventCode($event_unique_code, $last_inserted_id)
   {
      $response = Event::where('id', $last_inserted_id)
                            ->update([
                                'event_unique_code' => $event_unique_code
                            ]);
      return $response;
   }
   public function fetch_event_filter()
   {      
      if(Auth::user()->role_type === 'Admin'){

         $response = DB::table("events")->select('*')
         ->get();

      }else{

         $logined_empID = Auth::user()->empID;
         $response = DB::table('event_attendees')
                  ->distinct()         
                  ->select('events.*')         
                  ->join('events', 'event_attendees.event_id', '=', 'events.event_unique_code')
                  ->where('event_attendees.candidate_name', $logined_empID)
                  ->get();

      }
      
      return $response;
   }
   public function fetch_event_edit($id)
   {
      $response = Event::where('id', $id)
                        ->get();
      return $response;

   }   
   public function event_delete($id)
   {
      $response = Event::where('id', $id)
                        ->delete();
      return $response;

   }
   public function event_attendees_get($id)
   {
      $response = DB::table("event_attendees")->where('event_id', $id)->get();
      return $response;

   }
   public function event_attendees_delete($id)
   {
      $response = DB::table("event_attendees")->where('event_id', $id)->delete();
      return $response;

   }
   public function event_update($data)
   {
      $response = Event::where('id', $data['event_update_id'])
                        ->update(array(
                           'event_name' => $data['event_name'],
                           'label_color' => $data['label_color'],
                           'where' => $data['where'],
                           'description' => $data['description'],
                           'start_date_time' => $data['start_date_time'],
                           'end_date_time' => $data['end_date_time'],
                           'repeat' => $data['repeat'],
                           'repeat_every' => $data['repeat_every'],
                           'repeat_cycles' => $data['repeat_cycles'],
                           'repeat_type' => $data['repeat_type'],
                           'category_name' => $data['category_name'],
                           'event_type' => $data['event_type'],
                           'candicate_list' => $data['candicate_list'],
                        ));
      return $response;
   }
   
}


?>