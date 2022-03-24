<?php

Route::prefix('datatable/')->group(function () {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('menus','System\Menu\Controllers\MenuDatatableController@getData')->name('datatable.menus');
        Route::get('roles','System\Role\Controllers\RoleDatatableController@getData')->name('datatable.roles');
        Route::get('users','System\User\Controllers\UserDatatableController@getData')->name('datatable.users');
        Route::get('permissions','System\Permission\Controllers\PermissionDatatableController@getData')->name('datatable.permissions');
        Route::get('imports','System\Import\Import\Controllers\ImportDatatableController@getData')->name('datatable.imports');
        Route::get('import-files/{slug}','System\Import\ImportFile\Controllers\ImportFileDatatableController@getData')->name('datatable.import-files');
        Route::get('queueImports','System\Import\Queue\Controllers\QueueImportDatatableController@getData')->name('datatable.queuedImports');
        //contacts
        Route::get('contacts','Contact\Controllers\ContactDatatableController@getData')->name('datatable.contacts');
        //workplaces
        Route::get('workplaces','Client\Workplace\Controllers\WorkplaceDatatableController@getData')->name('datatable.workplaces');
        Route::get('destinations','Transport\Destination\Controllers\DestinationDatatableController@getData')->name('datatable.destinations');
        Route::get('shifts','Internal\Shift\Controllers\ShiftDatatableController@getData')->name('datatable.shifts');
        Route::get('mobiles','Internal\Mobile\Controllers\MobileDatatableController@getData')->name('datatable.mobiles');
        Route::get('drivers','Internal\Driver\Controllers\DriverDatatableController@getData')->name('datatable.drivers');
        Route::get('allTransports','Internal\Driver\Race\Controllers\DriverRaceDatatableController@getData')->name('datatable.allTransports');
    });
});
