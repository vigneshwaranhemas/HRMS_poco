<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/hr_dashboard', 'HrController@hr_dashboard')->name('candidate_dashboard');
Route::get('/hr_goals', 'HrController@hr_goals')->name('hr_goals');
Route::get('/hr_goal_setting', 'HrController@hr_goal_setting')->name('hr_goal_setting');
Route::get('/hr_add_goal_setting', 'HrController@hr_add_goal_setting')->name('hr_add_goal_setting');

//Buddy Controller
Route::get('/buddy_dashboard', 'BuddyController@buddy_dashboard')->name('candidate_dashboard');
Route::get('buddy', 'BuddyController@buddy_info')->name('buddy_info');
Route::get('/buddy_goals', 'BuddyController@buddy_goals')->name('buddy_goals');
Route::get('/buddy_goal_setting', 'BuddyController@buddy_goal_setting')->name('buddy_goal_setting');
Route::get('/buddy_add_goal_setting', 'BuddyController@buddy_add_goal_setting')->name('buddy_add_goal_setting');

//Candidate Controller
Route::get('/candidate_dashboard', 'CandidateController@candidate_dashboard')->name('candidate_dashboard');
Route::get('/candidate_goals', 'CandidateController@candidate_goals')->name('candidate_goals');
Route::get('/candidate_goal_setting', 'CandidateController@candidate_goal_setting')->name('candidate_goal_setting');
Route::get('/candidate_add_goal_setting', 'CandidateController@candidate_add_goal_setting')->name('candidate_add_goal_setting');

//Admin Controller  
Route::get('/admin_dashboard', 'AdminController@admin_dashboard')->name('candidate_dashboard');
Route::get('/admin_goals', 'AdminController@admin_goals')->name('admin_goals');
Route::get('/admin_goal_setting', 'AdminController@admin_goal_setting')->name('admin_goal_setting');
Route::get('/admin_add_goal_setting', 'AdminController@admin_add_goal_setting')->name('admin_add_goal_setting');
Route::get('holidays', 'AdminController@holidays')->name('holidays');
Route::get('events','AdminController@events');
Route::get('events-category','AdminController@create');

//Login Controller

//Calendaer Event
Route::post('event_category_insert', 'EventCategoryController@event_category_insert');
Route::post('event_category_delete', 'EventCategoryController@event_category_delete');
Route::get('fetch_event_category_all', 'EventCategoryController@fetch_event_category_all');

Route::post('event_type_insert', 'EventTypeController@event_type_insert');
Route::post('event_type_delete', 'EventTypeController@event_type_delete');
Route::get('fetch_event_type_all', 'EventTypeController@fetch_event_type_all');

Route::post('add_new_event_insert', 'EventController@add_new_event_insert');
Route::get('fetch_all_event', 'EventController@fetch_all_event');
Route::get('fetch_event_edit', 'EventController@fetch_event_edit');
Route::get('fetch_select_option_event_category', 'EventCategoryController@fetch_select_option_event_category');
Route::get('fetch_selected_event_type', 'EventTypeController@fetch_selected_event_type');
Route::get('fetch_event_attendees_list', 'EventController@fetch_event_attendees_list');
Route::get('fetch_event_attendees_show', 'EventController@fetch_event_attendees_show');
Route::post('event_delete', 'EventController@event_delete');
Route::post('event_update', 'EventController@event_update');
