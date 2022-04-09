<?php

namespace App\Repositories;

use App\business_unit;

class AdminRepository implements IAdminRepository
{
    public function add_business_unit_process( $form_data ){

      $response=business_unit::insert($form_data);
      return $response;
    }
}
