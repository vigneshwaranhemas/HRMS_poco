<?php

namespace App\Http\Controllers;

use App\Repositories\IAdminRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;

use Session;

class SidebarController extends Controller
{
	public function get_session_sidebar(Request $req){

		 $session_val = Session::get('session_info');
         $emp_ID = $session_val['empID'];
         $cdID = $session_val['cdID'];
         // echo "1<pre>";print_r($session_val);die;
         
         if ($emp_ID !="") {
         	$user = DB::table('role_permissions')->where('empID', '=', $emp_ID)->get();
         	// echo "1<pre>";print_r($user);die;
         }else{
         	$user = DB::table( 'role_permissions' )->where('cdID', '=', $cdID)->get();
         	// echo "2<pre>";print_r($user);die;
         }

                  

    }

}