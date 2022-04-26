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
Route::get("UserEmailSend","LoginController@UserEmailSend");
Route::get('dashboard','AdminController@permission');
Route::get('com_dashboard','AdminController@com_dashboard');




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
Route::get('/hrsspreOnboarding','HrController@preOnboarding');
Route::get("hrssdayzero","HrController@DayZero");
Route::get("hrssOnBoarding","HrController@hrssOnBoarding");
Route::get('seating_readiness',"HrController@SeatingArrangement");
Route::get('EmailIdCreation','HrController@EmailIdCreation');
Route::get('hrssCandidate','HrController@Candidate');
Route::get('userdocuments','HrController@userdocuments');
Route::post('view_preonboarding','HrController@Show_preOnBoarding');
Route::post('Email_and_Seat_request','HrController@EmailAndSeatingRequest');
Route::get('Candidate_Email_Creation','HrController@Candidate_Email_Creation');
Route::post('Candidate_Email_Status_update','HrController@Candidate_Email_Status_update');
Route::post('DocumentStatusUpdate','HrController@UpdateDocumentStatus');
Route::post('Candidate_Status_Update','HrController@CandidateOnboardStatusUpdate');


//Buddy Controller

Route::get('/buddy_dashboard', 'BuddyController@buddy_dashboard')->name('candidate_dashboard');
Route::get('buddy', 'BuddyController@buddy_info')->name('buddy_info');
Route::post('show_buddy_feedback','BuddyController@View_Buddy_feedback');


//Candidate Controller
Route::get('/candidate_dashboard', 'CandidateController@candidate_dashboard')->name('candidate_dashboard');
Route::get('/preOnboarding','CandidateController@preOnboarding');
Route::get('Buddy_feedback', 'CandidateController@buddy')->name('buddy_feedback');
Route::post('/PreOnBoarding_save','CandidateController@insertPreOnboarding');
Route::get('candidate_profile','CandidateController@profile');
Route::post("SaveBuddyFeedback",'candidateController@InsertBuddyFeedback');
Route::get('Candidate_Induction','CandidateController@CandidateInduction');
Route::get('Candidate_Assigned_Buddy','CandidateController@Candidate_Assigned_Buddy');



//Calendaer Event

Route::get('events','EventController@events')->name('events');
// Route::get('events-category','AdminController@create');
Route::post('add_new_event_insert', 'EventController@add_new_event_insert');
Route::get('fetch_all_event', 'EventController@fetch_all_event');
Route::get('fetch_event_edit', 'EventController@fetch_event_edit');
Route::get('fetch_select_option_event_category', 'EventCategoryController@fetch_select_option_event_category');
Route::get('fetch_selected_event_type', 'EventTypeController@fetch_selected_event_type');
Route::get('fetch_event_attendees_list', 'EventController@fetch_event_attendees_list');
Route::get('fetch_event_attendees_show', 'EventController@fetch_event_attendees_show');
Route::post('event_delete', 'EventController@event_delete');
Route::post('event_update', 'EventController@event_update');

Route::post('event_category_insert', 'EventCategoryController@event_category_insert');
Route::post('event_category_delete', 'EventCategoryController@event_category_delete');
Route::get('fetch_event_category_all', 'EventCategoryController@fetch_event_category_all');

Route::post('event_type_insert', 'EventTypeController@event_type_insert');
Route::post('event_type_delete', 'EventTypeController@event_type_delete');
Route::get('fetch_event_type_all', 'EventTypeController@fetch_event_type_all');

Route::get('/Hr_SeatingRequest','AdminController@Hr_SeatingRequest');
Route::post("/Admin_Seating_Request","AdminController@Admin_Seating_Allotment");
Route::post('/Admin_Request_update',"AdminController@Seating_Status_update");

//Goals Controller
Route::get('goals', 'GoalsController@goals')->name('goals');
Route::get('goal_setting', 'GoalsController@goal_setting')->name('goal_setting');
Route::get('add_goal_setting', 'GoalsController@add_goal_setting')->name('add_goal_setting');

//Holidays Controller
Route::get('holidays', 'HolidayController@holidays')->name('holidays');
Route::get('fetch_holidays_list', 'HolidayController@fetch_holidays_list')->name('fetch_holidays_list');
Route::get('fetch_holidays_list_id', 'HolidayController@fetch_holidays_list_id');
Route::get('fetch_holidays_list_date', 'HolidayController@fetch_holidays_list_date');
Route::post( 'add_new_holidays_insert', 'HolidayController@add_new_holidays_insert' );
Route::post( 'holidays_update', 'HolidayController@holidays_update' );
Route::post( 'holidays_delete', 'HolidayController@holidays_delete' );

//ItINfra Controller

Route::get('/ItInfra_Dashboard','ItInfraController@index');
Route::get('/EmailCreation','ItInfraController@EmailIdCreation');
Route::post('ITInfra_Email_Creation','ItInfraController@ITInfra_Email_Creation');
Route::get('/hr_dashboard', 'HrController@hr_dashboard')->name('hr_dashboard');


//Buddy Controller
Route::get('/buddy_dashboard', 'BuddyController@buddy_dashboard')->name('buddy_dashboard')->middleware('is_admin');

//Candidate Controller


// dashboard load admin
//Route::get('/admin', 'AdminController@admin_dashboard')->name('admin');
Route::get('/permission', 'AdminController@permission')->name('permission');
Route::post( 'role_list', 'AdminController@role_list' );
Route::post( 'menu_listing', 'AdminController@menu_listing' );
Route::post( 'sub_menu_save_tab', 'AdminController@sub_menu_save_tab' );

//Super Admin
Route::get('site_admin_dashboard', 'SiteAdminController@site_admin_dashboard')->name('admin_dashboard');

//Admin Controller
Route::get('admin_dashboard', 'AdminController@admin_dashboard')->name('admin_dashboard');
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
Route::get('employee_list', 'AdminController@employee_list')->name('employee_list');

//Employee List
Route::post('get_employee_list', 'AdminController@get_employee_list' );

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
Route::get('welcome_aboard', 'CandidateController@welcome_aboard')->name('welcome_aboard');
Route::post('add_welcome_aboard_process', 'CandidateController@add_welcome_aboard_process');

// View Welcome Aboard
Route::get('view_welcome_aboard', 'CandidateController@view_welcome_aboard')->name('view_welcome_aboard');
Route::post( 'get_welcome_aboard_details', 'CandidateController@get_welcome_aboard_details' );
Route::get('welcome_aboard_generate_pdf','CandidateController@welcome_aboard_generate_pdf');

/*image upload profile*/
Route::post('profile_upload_images', 'AdminController@storeImage');
Route::post('profile_display_images', 'AdminController@PreviewImage');
Route::get('roles_s', 'AdminController@roles_s')->name('roles_s');

/*roles*/
Route::post('add_roles_process', 'AdminController@add_roles_process');
Route::post('get_role_data', 'AdminController@get_role_data');
Route::post( 'get_role_details_pop', 'AdminController@get_role_details_pop' );
Route::post( 'update_role_unit_details', 'AdminController@update_role_unit_details' );

/*profile document*/
Route::post('documents_insert','DocumentsController@store')->name('Documents');
Route::post('documents_info_pro', 'DocumentsController@doc_information');
Route::post('profile_account_info_add', 'DocumentsController@profile_account_add');
Route::post('account_info_get', 'DocumentsController@account_info_get_res');
Route::post('education_information_insert', 'DocumentsController@education_information_add');
Route::post('education_information_view', 'DocumentsController@education_info_view');
Route::post('experience_info_view', 'DocumentsController@experience_info_result');
Route::post('add_contact_info', 'DocumentsController@add_contact_info');
Route::post('Contact_info_view', 'DocumentsController@Contact_info_view');
Route::post('add_family_add', 'DocumentsController@add_family_add');
Route::post('family_information_view', 'DocumentsController@family_information_view');
/*session sidebar*/
Route::post('get_session_sidebar', 'SidebarController@get_session_sidebar');
Route::post('state_get', 'DocumentsController@state_get');
Route::post('get_district', 'DocumentsController@get_district');
Route::post('get_district_cur', 'DocumentsController@get_district_cur');
Route::post('get_town_name', 'DocumentsController@get_town_name');
Route::post('get_town_name_curr', 'DocumentsController@get_town_name_curr');

/*roles*/
Route::post('add_roles_process', 'AdminController@add_roles_process');
Route::post('get_role_data', 'AdminController@get_role_data');
Route::post( 'get_role_details_pop', 'AdminController@get_role_details_pop' );
Route::post( 'update_role_unit_details', 'AdminController@update_role_unit_details' );

// View Welcome Aboard
Route::get('view_welcome_aboard_hr', 'HrController@view_welcome_aboard_hr')->name('view_welcome_aboard_hr');
Route::post('welcome_aboard_generate_image','HrController@welcome_aboard_generate_image');

/*employe list edit*/
Route::post('get_role_type', 'AdminController@get_role_type');
Route::post( 'get_employee_pop', 'AdminController@get_employee_pop' );
Route::post('update_employee_list_pop', 'AdminController@update_employee_list_pop');


