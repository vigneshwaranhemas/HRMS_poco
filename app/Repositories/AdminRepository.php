<?php
namespace App\Repositories;

use App\band;
use App\blood_group;
use App\business_unit;
use App\client;
use App\department;
use App\designation;
use App\division;
use App\function_master;
use App\grade;
use App\location;
use App\roll;
use App\state;
use App\zone;
use Illuminate\Support\Facades\DB;
use App\menu;
use App\sub_menu;
use App\role_permission;
use App\Role;

class AdminRepository implements IAdminRepository
{

	/*menu list*/
    public function get_role_list_base(){

        $permission_menu_data = Role::get();
                // echo "<pre>";print_r($permission_menu_data);die;
        return $permission_menu_data;
    }

    public function get_menu_list_res($role_id){
        $role_id = $role_id['role_id'];

        DB::enableQueryLog();
        $menu=DB::table('menus')->get();
        $menu_items=array();
        foreach($menu as $value){
            $submenu=DB::table('sub_menus')->where('menu_id',$value->menu_id)->get();
            $sub_menu_items=array();
            foreach($submenu as $val){
                $role_data=DB::table('role_permissions')->where('menu',$val->menu_id)->where('role',$role_id)->where('sub_menu',$val->sub_menu_name)->get();
                // dd(DB::getQueryLog());
                // echo"<pre>";print_r($role_data);die;
                if($role_data !=""){
                    if($role_data['0']->view==0){
                        $view='';
                    }else{
                        $view='checked';
                    }
                    if($role_data['0']->update==0){
                        $update='';
                    }else{
                        $update='checked';
                    }
                    if($role_data['0']->add==0){
                        $add='';
                    }else{
                        $add='checked';
                    }
                    if($role_data['0']->delete==0){
                        $delete='';
                    }else{
                        $delete='checked';
                    }
                }else{
                    $view=" ";
                    $update=" ";
                    $add=" ";
                    $delete=" ";
                }
                $sub = "<tr><td><input type='hidden' value=".$value->menu_id."></td><td> ".$val->sub_menu_name."</td>
                <td><input type='checkbox' class='js-switch packeges' name='checking' ".$view." style='margin-left: 10%;'></td>
                <td><input type='checkbox' class='js-switch packeges' name='checking' ".$update." style='margin-left: 10%;'></td>
                <td><input type='checkbox' class='js-switch packeges' name='checking' ".$add." style='margin-left: 10%;'></td>
                <td><input type='checkbox' class='js-switch packeges' name='checking' ".$delete." style='margin-left: 10%;'></td>
                </tr>";
                array_push($sub_menu_items,$sub);
                 // echo"<pre>";print_r($sub);
            } 
                 // die;
            $subitems=implode(' ', $sub_menu_items);
            $menu="<tr class='test_data2'><td><b>".$value->menu_name."</td>".$subitems."</tr>";
            array_push($menu_items,$menu);
        }
        return implode(' ',$menu_items);
    }

    /*role permission save list in table */
    public function get_submenu_save_res($form_data){
        $response = role_permission::insert($form_data);
      return $response;
    }

}
