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

//Candidate Controller
Route::get('/candidate_dashboard', 'CandidateController@candidate_dashboard')->name('candidate_dashboard');
Route::get('/preOnboarding','CandidateController@preOnboarding');
Route::get('Buddy_feedback', 'CandidateController@buddy')->name('buddy_feedback');

//Admin Controller
Route::get('/admin_dashboard', 'AdminController@admin_dashboard')->name('candidate_dashboard');
Route::get('/Hr_SeatingRequest','AdminController@Hr_SeatingRequest');

//Login Controller



//ItINfra Controller

Route::get('/ItInfra_Dashboard','ItInfraController@index');
Route::get('/EmailCreation','ItInfraController@EmailIdCreation');

