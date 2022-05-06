<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Auth;
use App\PeopleStar; 

class PeopleRepository implements IPeopleRepository
{
  
   public function fetch_customuser_list()
   { 
      $response = DB::table("customusers")->get()->toArray();
      return $response;
   }
   public function fetch_starred_customusers_list()
   {           
      $login_id = Auth::user()->empID;      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');

      if(!empty($check)){
         
         $arrayStarred =json_decode($check);
         
         $response = '';

         foreach($arrayStarred as $starred_empID){
            // dd($starred_empID);
            $username = DB::table("customusers")->where('empID', $starred_empID)->value('username');
            $designation = DB::table("customusers")->where('empID', $starred_empID)->value('designation');

            $response .= '<li class="clearfix people_list_ul_li" data-id="'.$starred_empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
            $response .= '<div class="about">';
            $response .= '<div class="name">'.$username.' <small><span class="digits">(#'.$starred_empID.')</span></small></div>';
            $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$designation.'</div>';
            $response .= '</div>';
            $response .= '</li>';

         }

      }else{
         $response = 'empty';
      }
      
      return $response;
   } 
   public function fetch_everyone_customusers_list()
   {           
      $customusers = DB::table("customusers")->get();

      if(!empty($customusers)){
                  
         $response = '';

         foreach($customusers as $customuser){

            $login_id = Auth::user()->empID;      
            $check = PeopleStar::where('created_by', $login_id)->value('starred');
            $emp_id = $customuser->empID;

            if(!empty($check)){
                              
               $arrayStarred =json_decode($check);

               if(($key = array_search($emp_id, $arrayStarred)) !== false){
                  // dd("have");
                  // <i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i>

                  $response .= '<li class="clearfix people_list_ul_li" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                  $response .= '<div class="about">';
                  $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.') <i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star star_class_name"></i></span></small></div>';
                  $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
                  $response .= '</div>';
                  $response .= '</li>';                  

               }else{

                  $response .= '<li class="clearfix people_list_ul_li" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                  $response .= '<div class="about">';
                  $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.')</span></small></div>';
                  $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
                  $response .= '</div>';
                  $response .= '</li>';

               }

            }else{

               $response .= '<li class="clearfix people_list_ul_li" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
               $response .= '<div class="about">';
               $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.')</span></small></div>';
               $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
               $response .= '</div>';
               $response .= '</li>';

            }            

         }

      }else{
         $response = 'empty';
      }

      // $response .= '<li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
      // $response .= '<div class="about">';
      // $response .= '<div class="name">fsdgs <small><span class="digits">(#fsdgs)</span></small></div>';
      // $response .= '<div class="status"><i class="fa fa-share font-success"></i>  fsdgs</div>';
      // $response .= '</div>';
      // $response .= '</li>';
      // $response .= '<li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
      // $response .= '<div class="about">';
      // $response .= '<div class="name">fsdgs<small><span class="digits">(#fsdgs)</span></small></div>';
      // $response .= '<div class="status"><i class="fa fa-share font-success"></i>  fsdgs</div>';
      // $response .= '</div>';
      // $response .= '</li>';
      
      return $response;
   } 
   public function fetch_people_starred_first_empid()
   {           
      $login_id = Auth::user()->empID;      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');
      // dd($check);

      if(!empty($check)){         
         $arrayStarred =json_decode($check);
         
         if(!empty($arrayStarred[0])){ 
            $response = $arrayStarred[0];
         }else{
            $response = 'empty';
         }
      }else{
         $response = 'empty';
      }
      
      return $response;
   }
   public function fetch_people_everyone_first_empid()
   {           

      $customusers = DB::table("customusers")->first("empID");
      
      if(!empty($customusers)){         
         $response = $customusers->empID;
      }else{
         $response = 'empty';
      }
      
      return $response;
   }
   public function fetch_people_list_filter($employee)
   {      
      $result = DB::table("customusers")->where('empID', $employee)->orwhere('username', $employee)->get();      
      if(!empty($result)){
         $response = $result;
      }else{
         $response = 'empty';
      }
      return $response;
   }
   public function fetch_people_star_add($emp_id)
   {      
      $login_id = Auth::user()->empID;
      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');
            
      //New entry
      if(!empty($check)){
         // dd($check);

         //delete element in array by value "un starred empID"
         $arrayStarred =json_decode($check);

         if(($key = array_search($emp_id, $arrayStarred)) !== false) {
            // dd("have");
            unset($arrayStarred[$key]);

            $update_arrayStarred = array();

            foreach($arrayStarred as $value){            
               
               array_push($update_arrayStarred,$value);

            }

            // dd($update_arrayStarred);

            $response = PeopleStar::where('created_by', $login_id)
                              ->update([
                                 'starred' => json_encode($update_arrayStarred)
                              ]);

            $response = 'star_removed';

         }else{
            // dd("new");
            $arrayStarred =json_decode($check);
            array_push($arrayStarred,$emp_id);  

            // dd($arrayStarred);

            $response = PeopleStar::where('created_by', $login_id)
                              ->update([
                                 'starred' => json_encode($arrayStarred)
                              ]);
            $response = 'star_addded';
         }

                 
      }else{
         // dd("new entry empID");

         $arrayStarred = array();

         array_push($arrayStarred,$emp_id);

         // dd(json_encode($arrayStarred));
         
         $data = array(
            'created_by' => $login_id,
            'starred' => json_encode($arrayStarred),
         );

         $response = PeopleStar::insert($data);

         $response = 'star_addded';
      }
      
      return $response;
   }   
   public function fetch_people_list_filter_star($employee)
   {      
      $login_id = Auth::user()->empID;
      $check = PeopleStar::where('created_by', $login_id)->value('starred');
      $username = DB::table("customusers")->where('empID', $employee)->value('username');      
      
      if(!empty($check)){
         
         $arrayStarred =json_decode($check);
         
         if(($key = array_search($employee, $arrayStarred)) !== false){
            // dd("have");
            $response = '<a href="javascript:void(0);" class="people_star_add" id="people_star_add" data-id="'.$employee.'" data-username="'.$username.'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star star_class_name"></i></a>';
         }else{
            // dd("no");

            $response = '<a href="javascript:void(0);" class="people_star_add" id="people_star_add" data-id="'.$employee.'" data-username="'.$username.'"><i id="star_class_name" class="fa fa-star star_class_name"></i></a>';
         }

      }else{
         $response = '<a href="javascript:void(0);" class="people_star_add" id="people_star_add" data-id="'.$employee.'" data-username="'.$username.'"><i id="star_class_name" class="fa fa-star star_class_name"></i></a>';
      }

      // dd($response);
      
      return $response;
   }
}
