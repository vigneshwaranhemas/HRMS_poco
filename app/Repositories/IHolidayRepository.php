<?php

namespace App\Repositories;

interface IHolidayRepository {

    public function add_holidays_insert( $data );
    public function fetch_holidays_list();
    public function fetch_holidays_state_filter($state);
    public function fetch_holidays_list_id($id);
    public function fetch_holidays_state_id($id);
    public function holidays_update($data);
    public function holidays_update_file($data);
    public function holidays_delete($id);
    public function fetch_holidays_list_date($filter_date);
    public function fetch_state_list();
    
}
