<?php

Route::middleware('auth')->group(function() {
    //exportsGeneral
    Route::get('exports','Exports\Controllers\ExportController@index')->name('exports.index');

    Route::prefix('export/')->group(function () {
        //system exports
        Route::get('menus','System\Menu\Controllers\ExportMenusController')->name('export.menus');
        Route::get('roles','System\Role\Controllers\ExportRolesController')->name('export.roles');
        Route::get('users','System\User\Controllers\ExportUsersController')->name('export.users');
        Route::get('permissions','System\Permission\Controllers\ExportPermissionsController')->name('export.permissions');
        Route::get('permissions','System\Permission\Controllers\ExportPermissionsController')->name('export.permissions');
        //client
      });

});

Route::get('exports/queued/{file_name}','Exports\Controllers\ExportController@downloadQueued')->name('exports.downloadQueued');

