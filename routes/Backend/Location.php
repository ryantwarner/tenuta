<?php

Route::group([
//        'namespace' => 'Location',
        'middleware' => 'access.routeNeedsPermission:manage-locations',
    ], function() {
        
        /**
         * For DataTables
         */
        Route::post('location/get', 'Location\LocationTableController')->name('location.get');
    
        /**
         * User CRUD
         */
        Route::resource('location', 'LocationController');
        
        Route::group([
            'namespace' => 'Unit',
            'middleware' => 'access.routeNeedsPermission:manage-units'
        ], function() {
            
        });
        
    }
);