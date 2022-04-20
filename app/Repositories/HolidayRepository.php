<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Holidays; 

class HolidayRepository implements IHolidayRepository
{

    public function add_holidays_insert( $data ){
        $response = Holidays::insert($data);
        return $response;
    }
    public function fetch_holidays_list()
    {      
       $response = DB::table("holidays")->select('*')
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
    public function holidays_update($data)
    {
       $response = Holidays::where('id', $data['id'])
                         ->update(array(
                            'occassion' => $data['occassion'],
                            'description' => $data['description'],                            
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
   
}
