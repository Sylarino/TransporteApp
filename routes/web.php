<?php
Route::middleware('auth')->group(function() {
    Route::resource('contacts','Contact\Controllers\ContactController');
    Route::resource('workplaces','Client\Workplace\Controllers\WorkplaceController');
    Route::resource('destinations','Transport\Destination\Controllers\DestinationController');
    Route::resource('shifts','Internal\Shift\Controllers\ShiftController');
    Route::resource('mobiles','Internal\Mobile\Controllers\MobileController');
    Route::resource('drivers','Internal\Driver\Controllers\DriverController');

    //driver shift and races
    Route::get('driverRaces','Internal\Driver\Controllers\DriverShiftRacesController@index')->name('driver-shift-races');
    Route::post('driverCreatesShift','Internal\Driver\Controllers\DriverShiftRacesController@createShift');
    Route::post('addRace/{id}','Internal\Driver\Race\Controllers\DriverRaceController@createRace');
    Route::get('myShiftResume','Internal\Driver\Shift\Controllers\DriverShiftController@index')->name('myShiftResume');
    Route::get('allTransports','Internal\Driver\Race\Controllers\DriverRaceController@index')->name('allTransports');
    Route::get('allTransports/export','Internal\Driver\Race\Controllers\DriverRaceController@export')->name('allTransports.export');

});

Route::get('test', function() {

});

