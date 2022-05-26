<?php

namespace App\Repositories;

interface IGoalRepository {

    public function add_goals_insert($data);
    public function add_goals_update($data);
    public function insertGoalsCode($goal_unique_code, $last_inserted_id);
    public function get_goal_list();
    public function add_goal_btn();
    public function checkCustomUserSuperList();
    public function fetchGoalIdDetails($id);
    public function fetchGoalIdHead($id);
    public function fetchGoalIdDelete($id);
    
}
