<?php

namespace App\Repositories;

interface IGoalRepository {

    public function add_goals_insert($data);
    public function add_goals_update($data);
    public function insertGoalsCode($goal_unique_code, $last_inserted_id);
    public function get_goal_list();
    public function get_team_member_goal_list($input_details);
    public function get_reviewer_goal_list($input_details);
    public function get_bh_goal_list($input_details);
    public function get_hr_goal_list_tb($input_details);
    public function add_goal_btn();
    public function fetchSupervisorList();
    public function fetchReviewerList();
    public function checkCustomUserList();
    public function fetchGoalIdDetails($id);
    public function checkReviewerIDOrNot($id);
    public function checkHrReviewerIDOrNot($id);
    public function checkSupervisorIDOrNot($id);
    public function fetchGoalIdHead($id);
    public function goals_consolidate_rate_head($id);
    public function goals_sup_consolidate_rate_head($id);
    public function fetchGoalIdDelete($id);
    public function addGoalEmployeeSummary($id, $employee_summary);
    public function goals_status_update($data);
    public function fetch_supervisor_filter($supervisor_filter);
    public function fetch_reviewer_filter($reviewer_filter);
    public function fetch_team_leader_filter($team_leader_filter);
    public function check_goals_employee_summary($id);
    public function fetch_goals_employee_summary($id);
    public function get_supervisor_data($id);
     public function fetch_reviewer_res_data($empid);
     public function fetch_reviewer_tab_data($data);
     public function fetch_team_member_list($data);
     public function get_reviewer_goal_list_for_reviewer($input_details);
     public function get_supervisor_hr($data);
     public function get_hr_goal_list_for_tbl($data);
     public function get_manager_lsit($data);
     public function update_goals_sup($data);
}
