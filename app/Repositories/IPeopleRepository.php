<?php

namespace App\Repositories;

interface IPeopleRepository {

    public function fetch_customuser_list();    
    public function fetch_starred_customusers_list();    
    public function fetch_everyone_customusers_list();    
    public function fetch_people_starred_first_empid();    
    public function fetch_people_everyone_first_empid();    
    public function fetch_people_list_filter($employee);
    public function fetch_people_list_filter_star($employee);
    public function fetch_people_star_add($emp_id);
    
}
