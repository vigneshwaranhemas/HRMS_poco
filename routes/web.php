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
Route::get('/hr_dashboard', 'HrController@hr_dashboard')->name('candidate_dashboard');

Route::get('/hr_goals', 'HrController@hr_goals')->name('hr_goals');
Route::get('/hr_goal_setting', 'HrController@hr_goal_setting')->name('hr_goal_setting');
Route::get('/hr_add_goal_setting', 'HrController@hr_add_goal_setting')->name('hr_add_goal_setting');

Route::get('/hrsspreOnboarding','HrController@preOnboarding');
Route::get("hrssdayzero","HrController@DayZero");
Route::get("hrssOnBoarding","HrController@hrssOnBoarding");
Route::get('seating_readiness',"HrController@SeatingArrangement");
Route::get('EmailIdCreation','HrController@EmailIdCreation');
Route::get('hrssCandidate','HrController@Candidate');
Route::get('userdocuments','Hrcontroller@userdocuments');


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

Route::get('/preOnboarding','CandidateController@preOnboarding');
Route::get('Buddy_feedback', 'CandidateController@buddy')->name('buddy_feedback');


//Admin Controller
Route::get('/admin_dashboard', 'AdminController@admin_dashboard')->name('candidate_dashboard');

Route::get('/admin_goals', 'AdminController@admin_goals')->name('admin_goals');
Route::get('/admin_goal_setting', 'AdminController@admin_goal_setting')->name('admin_goal_setting');
Route::get('/admin_add_goal_setting', 'AdminController@admin_add_goal_setting')->name('admin_add_goal_setting');
Route::get('holidays', 'AdminController@holidays')->name('holidays');
Route::get('events','AdminController@events');
Route::get('events-category','AdminController@create');


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

Route::get('/Hr_SeatingRequest','AdminController@Hr_SeatingRequest');

//Login Controller



//ItINfra Controller

Route::get('/ItInfra_Dashboard','ItInfraController@index');
Route::get('/EmailCreation','ItInfraController@EmailIdCreation');

Route::get('/hr_dashboard', 'HrController@hr_dashboard')->name('hr_dashboard');

//Buddy Controller
Route::get('/buddy_dashboard', 'BuddyController@buddy_dashboard')->name('buddy_dashboard');

//Candidate Controller
Route::get('/candidate_dashboard', 'CandidateController@candidate_dashboard')->name('candidate_dashboard');
Route::get('candidate_profile','CandidateController@profile');



// dashboard load admin
//Route::get('/admin', 'AdminController@admin_dashboard')->name('admin');
Route::get('/permission', 'AdminController@permission')->name('permission');
Route::post( 'role_list', 'AdminController@role_list' );
Route::post( 'menu_listing', 'AdminController@menu_listing' );
Route::post( 'sub_menu_save_tab', 'AdminController@sub_menu_save_tab' );

//Admin Controller
Route::get('/admin_dashboard', 'AdminController@admin_dashboard')->name('candidate_dashboard');
Route::get('business', 'AdminController@business')->name('business');
Route::get('division', 'AdminController@division')->name('division');
Route::get('function', 'AdminController@function')->name('function');
Route::get('grade', 'AdminController@grade')->name('grade');
Route::get('band', 'AdminController@band')->name('band');
Route::get('location', 'AdminController@location')->name('location');
Route::get('blood', 'AdminController@blood')->name('blood');
Route::get('roll', 'AdminController@roll')->name('roll');
Route::get('department', 'AdminController@department')->name('department');
Route::get('designation_or_position', 'AdminController@designation_or_position')->name('designation_or_position');
Route::get('client', 'AdminController@client')->name('client');
Route::get('state', 'AdminController@state')->name('state');
Route::get('zone', 'AdminController@zone')->name('zone');
Route::get('personnel', 'AdminController@personnel')->name('personnel');
Route::get('user', 'AdminController@user')->name('user');
Route::get('roles', 'AdminController@roles')->name('roles');
Route::get('holidays', 'AdminController@holidays')->name('holidays');

// Business Unit
Route::post('add_business_unit_process', 'AdminController@add_business_unit');
Route::post( 'get_business_unit_database', 'AdminController@get_business_unit_database' );
Route::post( 'get_business_unit_details', 'AdminController@get_business_unit_details' );
Route::post( 'update_business_unit_details', 'AdminController@update_business_unit_details' );
Route::post( 'process_business_unit_status', 'AdminController@process_business_unit_status' );
Route::post( 'process_business_unit_delete', 'AdminController@process_business_unit_delete' );

// Division
Route::post('add_division_unit_process', 'AdminController@add_division_unit_process');
Route::post( 'get_division_unit_database', 'AdminController@get_division_unit_database' );
Route::post( 'get_division_unit_details', 'AdminController@get_division_unit_details' );
Route::post( 'update_division_details', 'AdminController@update_division_details' );
Route::post( 'process_division_status', 'AdminController@process_division_status' );
Route::post( 'process_division_unit_delete', 'AdminController@process_division_unit_delete' );

// Function
Route::post('add_function_process', 'AdminController@add_function_process');
Route::post( 'get_function_database', 'AdminController@get_function_database' );
Route::post( 'get_function_details', 'AdminController@get_function_details' );
Route::post( 'update_function_details', 'AdminController@update_function_details' );
Route::post( 'process_function_status', 'AdminController@process_function_status' );
Route::post( 'process_function_delete', 'AdminController@process_function_delete' );

// Grade
Route::post('add_grade_process', 'AdminController@add_grade_process');
Route::post( 'get_grade_database', 'AdminController@get_grade_database' );
Route::post( 'get_grade_details', 'AdminController@get_grade_details' );
Route::post( 'update_grade_details', 'AdminController@update_grade_details' );
Route::post( 'process_grade_status', 'AdminController@process_grade_status' );
Route::post( 'process_grade_delete', 'AdminController@process_grade_delete' );

// Location
Route::post('add_location_process', 'AdminController@add_location_process');
Route::post( 'get_location_database', 'AdminController@get_location_database' );
Route::post( 'get_location_details', 'AdminController@get_location_details' );
Route::post( 'update_location_details', 'AdminController@update_location_details' );
Route::post( 'process_location_status', 'AdminController@process_location_status' );
Route::post( 'process_location_delete', 'AdminController@process_location_delete' );

// Blood Group
Route::post('add_blood_process', 'AdminController@add_blood_process');
Route::post( 'get_blood_database', 'AdminController@get_blood_database' );
Route::post( 'get_blood_details', 'AdminController@get_blood_details' );
Route::post( 'update_blood_details', 'AdminController@update_blood_details' );
Route::post( 'process_blood_status', 'AdminController@process_blood_status' );
Route::post( 'process_blood_delete', 'AdminController@process_blood_delete' );


// Roll
Route::post('add_roll_process', 'AdminController@add_roll_process');
Route::post( 'get_roll_database', 'AdminController@get_roll_database' );
Route::post( 'get_roll_details', 'AdminController@get_roll_details' );
Route::post( 'update_roll_details', 'AdminController@update_roll_details' );
Route::post( 'process_roll_status', 'AdminController@process_roll_status' );
Route::post( 'process_roll_delete', 'AdminController@process_roll_delete' );

// Department
Route::post('add_department_process', 'AdminController@add_department_process');
Route::post( 'get_department_database', 'AdminController@get_department_database' );
Route::post( 'get_department_details', 'AdminController@get_department_details' );
Route::post( 'update_department_details', 'AdminController@update_department_details' );
Route::post( 'process_department_status', 'AdminController@process_department_status' );
Route::post( 'process_department_delete', 'AdminController@process_department_delete' );

// Designation
Route::post('add_designation_process', 'AdminController@add_designation_process');
Route::post( 'get_designation_database', 'AdminController@get_designation_database' );
Route::post( 'get_designation_details', 'AdminController@get_designation_details' );
Route::post( 'update_designation_details', 'AdminController@update_designation_details' );
Route::post( 'process_designation_status', 'AdminController@process_designation_status' );
Route::post( 'process_designation_delete', 'AdminController@process_designation_delete' );

// Designation
Route::post('add_state_process', 'AdminController@add_state_process');
Route::post( 'get_state_database', 'AdminController@get_state_database' );
Route::post( 'get_state_details', 'AdminController@get_state_details' );
Route::post( 'update_state_details', 'AdminController@update_state_details' );
Route::post( 'process_state_status', 'AdminController@process_state_status' );
Route::post( 'process_state_delete', 'AdminController@process_state_delete' );

// Zone
Route::post('add_zone_process', 'AdminController@add_zone_process');
Route::post( 'get_zone_database', 'AdminController@get_zone_database' );
Route::post( 'get_zone_details', 'AdminController@get_zone_details' );
Route::post( 'update_zone_details', 'AdminController@update_zone_details' );
Route::post( 'process_zone_status', 'AdminController@process_zone_status' );
Route::post( 'process_zone_delete', 'AdminController@process_zone_delete' );

// Band
Route::post('add_band_process', 'AdminController@add_band_process');
Route::post( 'get_band_database', 'AdminController@get_band_database' );
Route::post( 'get_band_details', 'AdminController@get_band_details' );
Route::post( 'update_band_details', 'AdminController@update_band_details' );
Route::post( 'process_band_status', 'AdminController@process_band_status' );
Route::post( 'process_band_delete', 'AdminController@process_band_delete' );

// Client
Route::post('add_client_process', 'AdminController@add_client_process');
Route::post( 'get_client_database', 'AdminController@get_client_database' );
Route::post( 'get_client_details', 'AdminController@get_client_details' );
Route::post( 'update_client_details', 'AdminController@update_client_details' );
Route::post( 'process_client_status', 'AdminController@process_client_status' );
Route::post( 'process_client_delete', 'AdminController@process_client_delete' );

// Welcome Aboard
Route::get('welcome_aboard', 'AdminController@welcome_aboard')->name('welcome_aboard');
Route::post('add_welcome_aboard_process', 'AdminController@add_welcome_aboard_process');

// View Welcome Aboard
Route::get('view_welcome_aboard', 'AdminController@view_welcome_aboard')->name('view_welcome_aboard');
Route::post( 'get_welcome_aboard_details', 'AdminController@get_welcome_aboard_details' );
// Route::get('welcome_aboard_pdf', 'AdminController@welcome_aboard_pdf')->name('welcome_aboard_pdf');
Route::get('welcome_aboard_generate_pdf','AdminController@welcome_aboard_generate_pdf');
// Route::get('generate-pdf','AdminController@generatePDF');

/*image upload profile*/
Route::post('profile_upload_images', 'AdminController@storeImage');
Route::get('roles_s', 'AdminController@roles_s')->name('roles_s');

/*roles*/
Route::post('add_roles_process', 'AdminController@add_roles_process');
Route::post('get_role_data', 'AdminController@get_role_data');
Route::post( 'get_role_details_pop', 'AdminController@get_role_details_pop' );
Route::post( 'update_role_unit_details', 'AdminController@update_role_unit_details' );
