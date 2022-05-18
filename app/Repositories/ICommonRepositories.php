<?php

namespace App\Repositories;

interface ICommonRepositories {
	public function get_candidate_info_hr( $input_details );
	public function get_candidate_exp_hr( $input_details );
	public function family_info_to_hr( $input_details );
    public function check_user_status($id);
    public function get_organization_info();
    public function get_organization_info_one();
    public function supervisor_wise_info($id);
}
