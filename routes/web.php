<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes(['verify' => true]);

// use Illuminate\Routing\Route;
//Your Client ID
//377260432412-5avasukoa0530sjv5nf10gs7d0tq3vms.apps.googleusercontent.com
//Your Client Secret
//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

use Illuminate\Support\Facades\Route;

Route::get('/', 'WelcomeController@welcome');
Route::get('doctor-profile/{slug}', 'WelcomeController@doctor_profile');
Route::get('all-reviews/{slug}', 'WelcomeController@all_reviews');
// Route::post('contact', 'ContactController@contact');
// Route::get('term-condition', 'WelcomeController@term_condition');
// Route::get('type/{id}', 'WelcomeController@type');
Route::get('ask-a-doctor', 'WelcomeController@ask_a_doctor');
Route::get('speciality/{id}', 'WelcomeController@speciality');
// Route::get('autocomplete', 'WelcomeController@slocation');
Route::match(['GET', 'POST'], 'search', 'WelcomeController@search');
Route::get('claim-profile/{id}', 'ClaimController@claimProfile');
Route::post('claim-profile/{id}', 'ClaimController@submitForClaimProfile');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Admin
// Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
// Route::get('category', 'CategoryController@index')->middleware('is_admin');
// Route::post('create-category', 'CategoryController@create_category')->middleware('is_admin');
// Route::post('delete-category/{id}', 'CategoryController@delete')->middleware('is_admin');
// Route::post('delete-patient/{id}', 'AdminController@delete_patient')->middleware('is_admin');
// Route::post('delete-review/{id}', 'AdminController@delete_review')->middleware('is_admin');
// Route::post('doctor-update/{id}', 'AdminController@doctor_update')->middleware('is_admin');
// // Route::get('doctors','AdminController@doctors')->middleware('is_admin');
// Route::resource('doctor', 'DoctorController')->middleware('is_admin');
// Route::get('active-doctor/{id}', 'AdminController@active_doctor')->middleware('is_admin');
// Route::get('inactive-doctor/{id}', 'AdminController@inactive_doctor')->middleware('is_admin');
// Route::get('doctor-profile-/{id}', 'AdminController@doctor_profile')->middleware('is_admin');
// Route::get('patients', 'AdminController@patients')->middleware('is_admin');
// Route::get('reviews', 'AdminController@reviews')->middleware('is_admin');
// Route::get('doctor-add', 'AdminController@doctor_add')->middleware('is_admin');
// Route::post('doctor-create', 'AdminController@doctor_create')->middleware('is_admin');
// Route::get('doctor-profile-add/{id}', 'AdminController@profile_add_doctor')->middleware('is_admin');
// Route::post('admin-education', 'AdminController@education')->middleware('is_admin');
// Route::post('admin-experience', 'AdminController@experience')->middleware('is_admin');
// Route::post('admin-awards', 'AdminController@awards')->middleware('is_admin');
// Route::post('admin-memberships', 'AdminController@memberships')->middleware('is_admin');
// Route::post('admin-registrations', 'AdminController@registrations')->middleware('is_admin');
// Route::get('hospitals', 'HospitalController@index')->middleware('is_admin');
// Route::get('settings', 'SettingController@index')->middleware('is_admin');
// Route::post('setting-update', 'SettingController@update')->middleware('is_admin');
// Route::get('hospital-create', 'HospitalController@create')->middleware('is_admin');
// Route::post('hospital-add', 'HospitalController@store')->middleware('is_admin');
// Route::post('delete-hospital/{id}', 'HospitalController@destroy')->middleware('is_admin');
// Route::resource('scraping', 'ScrapingController')->middleware('is_admin');
// Route::resource('claim', 'ClaimController')->middleware('is_admin');
// Route::post('review_claim/{id}', 'ClaimController@review_of_claim')->middleware('is_admin');

// < doctor route start_-->
// Route::get('doctor/home', 'HomeController@writerHome')->name('writer.home')->middleware('is_writer');
// Route::get('doctor-profile-settings', 'DoctorController@doctor_profile_settings')->middleware('is_writer');
// Route::post('doctor-profile-update/{id}', 'DoctorController@doctor_profile_update')->middleware('is_writer');
// Route::post('education', 'DoctorController@education')->middleware('is_writer');
// Route::post('experience', 'DoctorController@experience')->middleware('is_writer');
// Route::post('awards', 'DoctorController@awards')->middleware('is_writer');
// Route::post('memberships', 'DoctorController@memberships')->middleware('is_writer');
// Route::post('registrations', 'DoctorController@registrations')->middleware('is_writer');
// Route::get('review', 'DoctorController@review')->middleware('is_writer');
// Route::get('doctor-backround', 'DoctorController@doctor_backround')->middleware('is_writer');

// // < doctor route end-->

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/doctor', 'Auth\LoginController@showDoctorLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/doctor', 'Auth\RegisterController@showDoctorRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/doctor', 'Auth\LoginController@doctorLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/doctor', 'Auth\RegisterController@createDoctor');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin')->middleware('auth:admin');
Route::view('/doctor', 'doctor')->middleware('auth:doctor');

Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::resource('/booking', 'BookingController');

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'auth:admin',
    ],
    function () {
        Route::get('', 'DashboardController@index');
        Route::resource('speciality', 'SpecialityController');
        Route::resource('doctor', 'DoctorController');
        Route::resource('patient', 'PatientController');
        Route::resource('review', 'ReviewController');
        Route::resource('transaction', 'TransactionController');
        Route::resource('claim', 'ClaimController');
    }
);
Route::group(
    [
        'prefix' => 'doctor',
        'namespace' => 'Doctor',
        'middleware' => ['auth:doctor']
    ],
    function () {
        Route::get('', 'DashboardController@index')->middleware('check.doctor.status');
        Route::resource('schedule', 'ScheduleController')->middleware('check.doctor.status');
        Route::resource('appointment', 'AppointmentController')->middleware('check.doctor.status');
        Route::resource('review', 'ReviewController')->middleware('check.doctor.status');

        Route::get('registration/status', 'DashboardController@registrationStatus');

    }
);
Route::group(
    [
        'namespace' => 'Patient',
        'middleware' => ['auth'],
    ],
    function () {
        Route::resource('checkout', 'AppointmentController');
        Route::post('/pay-via-ajax', 'AppointmentController@payViaAjax');
        Route::post('/doctor-review', 'ReviewController@store');

    }
);

// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
// Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END
