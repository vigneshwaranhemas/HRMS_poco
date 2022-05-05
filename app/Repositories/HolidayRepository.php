<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Holidays; 

class HolidayRepository implements IHolidayRepository
{

    public function add_holidays_insert( $data ){
        $response = Holidays::insertGetId($data);
        return $response;
    }
    public function insertHolidayCode($holiday_unique_code, $last_inserted_id)
    {
       $response = Holidays::where('id', $last_inserted_id)
                             ->update([
                                 'holiday_unique_code' => $holiday_unique_code
                             ]);
       return $response;
    }
    public function fetch_holidays_list()
    {      
      // if(Auth::user()->role_type === 'Admin'){

      //    $response = DB::table("holidays")->select('*')
      //    ->get();

      // }else{

      //    // SELECT h.*
      //    // FROM candidate_contact_information cci
      //    // INNER JOIN holidays h
      //    // ON h.state = cci.p_State
      //    // WHERE cci.emp_id="900386";
        
         
      //    $logined_empID = Auth::user()->empID;
      //    // $response = DB::table('candidate_contact_information as cci')
      //    //          ->distinct()         
      //    //          ->select('h.*')         
      //    //          ->join('holidays as h', 'event_attendees.event_id', '=', 'events.event_unique_code')
      //    //          ->where('cci.state', $logined_empID)
      //    //          ->get();

      // }

      $response = DB::table("holidays")->select('*')
      ->get();
      
       return $response;
    }
    public function fetch_holidays_state_filter($state)
    {      
       $response = DB::table("holidays")->select('*')
                    ->where('state', $state)
                    ->get();
       return $response;
    }
    public function fetch_holidays_list_id($id)
    {      
       $response = DB::table('holidays')
                    ->select('*')
                    ->where('id', $id)
                    ->get();
       return $response;
    }
    public function fetch_holidays_state_id($id)
    {      
      $state_names = DB::table("towns_details")->select('state_name')
      ->groupByRaw('state_name')
      ->get();

      $output = '<option value="">Select State...</option>';

      foreach($state_names as $record){

         $response = DB::table('holidays')
                  ->where('id', $id)
                  ->where('state', $record->state_name)
                  ->value('state');
         
         if(!empty($response)){
            if($response == $record->state_name){  
               $output .= '<option value="'.$record->state_name.'" selected>'.$record->state_name.'</option>';
            }
         }else{
            $output .= '<option value="'.$record->state_name.'">'.$record->state_name.'</option>';
         }
         
      }

      return $output;
    }
    public function holidays_update($data)
    {
       $response = Holidays::where('id', $data['id'])
                         ->update(array(
                            'occassion' => $data['occassion'],
                            'description' => $data['description'],                            
                            'state' => $data['state'],                            
                         ));
       return $response;
    }
    public function holidays_update_file($data)
    {
       $response = Holidays::where('id', $data['id'])
                         ->update(array(
                            'occassion' => $data['occassion'],
                            'description' => $data['description'],                            
                            'occassion_file' => $data['occassion_file'],                            
                            'state' => $data['state'],                            
                         ));
       return $response;
    }
    public function holidays_delete($id)
    {
        $response = Holidays::where('id', $id)
                            ->delete();
        return $response;

    }
    public function fetch_holidays_list_date($filter_date)
    {
        $response = Holidays::where('date', 'LIKE', '%'.$filter_date.'%')
                            ->get();
        return $response;

    }
    public function fetch_state_list()
    {      
      $response = DB::table("towns_details")->select('state_name')
                        ->groupByRaw('state_name')
                        ->get();
      return $response;
    }
   
}
