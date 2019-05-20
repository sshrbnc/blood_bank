<?php

use App\Donor;
use Illuminate\Support\Facades\Input;

Route::get('/', ['uses' =>'AarticleController@home', 'as' => 'article.home']);
Route::get('/donar', ['uses' =>'DonarController@index', 'as' => 'donar.index']);
Route::get('/donar/{id}', ['uses' =>'DonarController@show', 'as' => 'donar.show']);

Route::get('transaction', ['uses' =>'TransactionsController@show', 'as' => 'transaction']);


// Route::get('/blog', ['uses' =>'BlogController@index', 'as' => 'blog.index']);
// Route::get('/blog/{id}', ['uses' =>'BlogController@show', 'as' => 'blog.show']);
// Route::get('/manuel', ['uses' =>'PageController@manuel', 'as' => 'page.manuel']);
// Route::get('/about-us', ['uses' =>'PageController@about', 'as' => 'page.about']);
// Route::get('/contact-us', ['uses' =>'PageController@contact', 'as' => 'page.contact']);


//Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::get('/home', 'HomeController@index');

//Roles
Route::resource('roles', 'Admin\RolesController');
Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    
//Users
Route::resource('users', 'Admin\UsersController');
Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
   
//Profiles
Route::resource('profiles', 'Admin\ProfilesController');
Route::post('profiles_mass_destroy', ['uses' => 'Admin\ProfilesController@massDestroy', 'as' => 'profiles.mass_destroy']);
Route::post('profiles_restore/{id}', ['uses' => 'Admin\ProfilesController@restore', 'as' => 'profiles.restore']);
Route::delete('profiles_perma_del/{id}', ['uses' => 'Admin\ProfilesController@perma_del', 'as' => 'profiles.perma_del']);

//Patients
Route::resource('patients', 'Admin\PatientsController');
Route::post('patients_mass_destroy', ['uses' => 'Admin\PatientsController@massDestroy', 'as' => 'patients.mass_destroy']);
Route::post('patients_restore/{id}', ['uses' => 'Admin\PatientsController@restore', 'as' => 'patients.restore']);
Route::get('/blood_requests/create/{id}', ['uses' => 'Admin\PatientsController@createBR', 'as' => 'patients.newBloodRequests']);
Route::delete('patients_perma_del/{id}', ['uses' => 'Admin\PatientsController@perma_del', 'as' => 'patients.perma_del']);

//Donors
 // Route::get('donors/{id}', [
 //    'as' => 'donors.create',
 //        'uses' => 'DonorsController@create'
 //    ]);
// Route::get('/create/{id}', 'Admin\DonorsController@create');
Route::resource('donors', 'Admin\DonorsController');
Route::post('donors_mass_destroy', ['uses' => 'Admin\DonorsController@massDestroy', 'as' => 'donors.mass_destroy']);
Route::post('donors_restore/{id}', ['uses' => 'Admin\DonorsController@restore', 'as' => 'donors.restore']);
Route::delete('donors_perma_del/{id}', ['uses' => 'Admin\DonorsController@perma_del', 'as' => 'donors.perma_del']);

Route::get('donations/create/{id}', ['uses' => 'Admin\DonorsController@newDonation', 'as' => 'donors.newDonation']);
Route::delete('donations_perma_del/{id}', ['uses' => 'Admin\DonationsController@perma_del', 'as' => 'donations.perma_del']);
Route::post('donations_restore/{id}', ['uses' => 'Admin\DonationsController@restore', 'as' => 'donations.restore']);

//Blood Request Requests
Route::get('/searchDonor',['uses' => 'Admin\BloodRequestsController@searchDonor', 'as' => 'br.searchDonor']);
Route::resource('blood_requests', 'Admin\BloodRequestsController');
Route::post('/blood_requests/{id}', ['uses' => 'Admin\BloodRequestsController@store', 'as' => 'blood_requests.store']);  
Route::get('/searchDonor',['uses' => 'Admin\BloodRequestsController@searchDonor', 'as' => 'br.searchDonor']);
Route::get('/blood_requests/assignDonor/{id}',['uses' => 'Admin\BloodRequestsController@assignDonor', 'as'=> 'br.assignDonor']);
// Route::get('/blood_requests/create/{id}', ['as' => 'blood_requests.create','uses' => 'Admin\BloodRequestsController@create', function ($id) {
//     //
//     return $id;
// }]);

//bloodrequests by status
Route::get('categorize', 'Admin\BloodRequestsController@showByStatus');

Route::get('/blood_requests/donorReceipient/{bcode}/{bid}/{did}',
	['uses' => 'Admin\BloodRequestsController@donorReceipient',
	'as' => 'br.donor_receipient']
	);


//Blood Requests
Route::resource('bloods', 'Admin\BloodsController');
Route::post('bloods_mass_destroy', ['uses' => 'Admin\BloodsController@massDestroy', 'as' => 'bloods.mass_destroy']);
Route::post('bloods_restore/{id}', ['uses' => 'Admin\BloodsController@restore', 'as' => 'bloods.restore']);
Route::delete('bloods_perma_del/{id}', ['uses' => 'Admin\BloodsController@perma_del', 'as' => 'bloods.perma_del']);

//Donations
Route::resource('donations', 'Admin\DonationsController');


});

//search
Route::get('/search', 'HomeController@search');


//Message test
Route::post('sms','Admin\PatientsController@sendSMS');
