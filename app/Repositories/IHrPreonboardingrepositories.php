<?php

namespace App\Repositories;

interface IHrPreonboardingrepositories{
   public function getonboardinginfo($userid,$status);
   public function get_candidate_info($id);
   public function get_onboarding_candidate_info();
   public function Update_mail_status($update_data);
   public function DayWiseCandidateInfo($data);
   public function get_email_info();
   public function Insert_Candidate_empId($data);
   public function Verify_emp_info($data);
   public function EmailIdCreation($data);
   public function get_itinfra_email_info();
   public function candidate_info_for_EmailCreation($id);
   public function get_hrRequested_info($status);





}


?>
