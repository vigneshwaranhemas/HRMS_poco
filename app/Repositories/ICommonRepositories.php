<?php

namespace App\Repositories;

interface ICommonRepositories {
	public function get_candidate_info_hr( $input_details );
    public function check_user_status($id);
    public function get_organization_info();
    public function supervisor_wise_info($id);
}
