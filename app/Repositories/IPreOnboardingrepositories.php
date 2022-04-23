<?php

namespace App\Repositories;


interface IPreOnboardingrepositories{

       public function Check_onBoard($table,$test);
       public function getonBoardingFields($table);
       public function insert_onboard($data);
       public function update_onboard($data,$id,$field);
       public function insert_buddy_feedback($data,$data1);
       public function get_buddy_info($id);
       public function get_canidate_info($table,$id);
       public function fetch_buddy_info($data);

       // Welcome aboard process start
    public function add_welcome_aboard_process( $form_data );
    public function get_welcome_aboard_details();
    // Welcome aboard process End

}

?>

