<?php

Route::get('/', ['uses' =>'AarticleController@home', 'as' => 'article.home']);
Route::get('/donar', ['uses' =>'DonarController@index', 'as' => 'donar.index']);
Route::get('/donar/{id}', ['uses' =>'DonarController@show', 'as' => 'donar.show']);
Route::get('/blog', ['uses' =>'BlogController@index', 'as' => 'blog.index']);
Route::get('/blog/{id}', ['uses' =>'BlogController@show', 'as' => 'blog.show']);
Route::get('/manuel', ['uses' =>'PageController@manuel', 'as' => 'page.manuel']);
Route::get('/about-us', ['uses' =>'PageController@about', 'as' => 'page.about']);
Route::get('/contact-us', ['uses' =>'PageController@contact', 'as' => 'page.contact']);


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

    // Route::resource('donors',   'Admin\DonorsController');

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
    
    //Donors
    Route::resource('donors', 'Admin\DonorsController');
    Route::post('donors_mass_destroy', ['uses' => 'Admin\DonorsController@massDestroy', 'as' => 'donors.mass_destroy']);
    Route::post('donors_restore/{id}', ['uses' => 'Admin\DonorsController@restore', 'as' => 'donors.restore']);
    Route::delete('donors_perma_del/{id}', ['uses' => 'Admin\DonorsController@perma_del', 'as' => 'donors.perma_del']);

});
