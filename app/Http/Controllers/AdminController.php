<?php

namespace App\Http\Controllers;

use App\Repositories\IAdminRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct(IAdminRepository $admrpy)
    {
        $this->admrpy = $admrpy;
    }

    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }
    public function permission()
    {
        return view('admin.permission');
    }
    /* role List */
    public function role_list(){
        $get_menu_list_result = $this->admrpy->get_role_list_base( );
        return response()->json( $get_menu_list_result );
    }
    /*menu listing */
    public function menu_listing(Request $req){
    // echo "<pre>";print_r($req->role_id);die();
        $role_id['role_id'] = $req->role_id;

        $get_menu_result = $this->admrpy->get_menu_list_res($role_id);
        return response()->json( $get_menu_result );
    }
    /*save a menu and sub-menu*/
    public function sub_menu_save_tab(Request $req){
   
      $data=$req->selected;
        // echo "<pre>";print_r($data);die();
      foreach ($data as $key => $value) {
         $res_array[]=array("role"=>$value['role'],
                            "menu"=>$value['menu'],
                           "sub_menu"=>$value['sub_menu'],
                           "view"=>$value['view'],
                           "update"=>$value['update'],
                           "add"=>$value['add'],
                           "delete"=>$value['delete']
                       );
      }
              // echo "<pre>";print_r($res_array);die();

        $get_menu_result = $this->admrpy->get_submenu_save_res( $res_array);

        return response()->json( $data );
    }
    
}
