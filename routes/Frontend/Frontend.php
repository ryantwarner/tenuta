<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');

Route::group(['as' => 'availabilities.'], function() {
    Route::get('unit/{id}', 'AvailabilitiesController@unit')->name('unit');
    Route::get('unit/{id}/images/{filename}', 'AvailabilitiesController@image')->name('image');
});

/**
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
	Route::group(['namespace' => 'User', 'as' => 'user.'], function() {
		/**
		 * User Dashboard Specific
		 */
		Route::get('dashboard', 'DashboardController@index')->name('dashboard');

		/**
		 * User Account Specific
		 */
		Route::get('account', 'AccountController@index')->name('account');

		/**
		 * User Profile Specific
		 */
		Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
	});
});