<?php

/**
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.auth'
 */
Route::group(['as' => 'application.'], function () {
	Route::group(['middleware' => 'guest'], function () {
            Route::get('apply/{id}', 'ApplicationsController@applicationForm')->name('apply');
            Route::post('apply/{id}', 'ApplicationsController@saveApplication')->name('save');
	});
});
