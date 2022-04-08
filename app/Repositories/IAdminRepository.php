<?php

namespace App\Repositories;

interface IAdminRepository {
	public function get_role_list_base( );
	public function get_menu_list_res($role_id );
	public function get_submenu_save_res($input_details );
}