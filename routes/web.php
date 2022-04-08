<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

/*login*/
Route::get('logout','AuthController@logout');
Route::post('login_check_process', 'LoginController@login_check_process' );


Route::get('dashboard','AdminController@permission');

Route::prefix('perk-ui')->group(function () {
    Route::view('animate', 'perk-ui.animate')->name('animate');
    Route::view('scroll-reval', 'perk-ui.scroll-reval')->name('scroll-reval');
    Route::view('aos', 'perk-ui.aos')->name('aos');
    Route::view('tilt', 'perk-ui.tilt')->name('tilt');
    Route::view('wow', 'perk-ui.wow')->name('wow');
    Route::view('hide-on-scroll', 'perk-ui.hide-on-scroll')->name('hide-on-scroll');
    Route::view('vertical', 'perk-ui.vertical')->name('vertical');
    Route::view('mega-menu', 'perk-ui.mega-menu')->name('mega-menu');
    Route::view('fix-header', 'perk-ui.fix-header')->name('fix-header');
    Route::view('fix-header&amp;sidebar', 'perk-ui.fix-header&amp;sidebar')->name('fix-header&amp;sidebar');
    Route::view('basic-card', 'perk-ui.basic-card')->name('basic-card');
    Route::view('theme-card', 'perk-ui.theme-card')->name('theme-card');
    Route::view('tabbed-card', 'perk-ui.tabbed-card')->name('tabbed-card');
    Route::view('dragable-card', 'perk-ui.dragable-card')->name('dragable-card');
    Route::view('button-builder', 'perk-ui.button-builder')->name('button-builder');
    Route::view('form-builder-1', 'perk-ui.form-builder-1')->name('form-builder-1');
});

//HR Controller
Route::get('/hr_dashboard', 'HrController@hr_dashboard')->name('hr_dashboard');

//Buddy Controller
Route::get('/buddy_dashboard', 'BuddyController@buddy_dashboard')->name('buddy_dashboard');

//Candidate Controller
Route::get('/candidate_dashboard', 'CandidateController@candidate_dashboard')->name('candidate_dashboard');
Route::get('candidate_profile','CandidateController@profile');


// dashboard load admin
Route::get('/admin', 'AdminController@admin_dashboard')->name('admin');
Route::get('/permission', 'AdminController@permission')->name('permission');
Route::post( 'role_list', 'AdminController@role_list' );
Route::post( 'menu_listing', 'AdminController@menu_listing' );
Route::post( 'sub_menu_save_tab', 'AdminController@sub_menu_save_tab' );

