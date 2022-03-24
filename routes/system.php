<?php
Route::middleware('auth')->group(function() {
    Route::view('/', 'welcome')->name('home');
    //userProfile
    Route::get('profile', 'User\Profile\Controllers\UserProfileController@index')->name('user.profile');
    //userSettings
    Route::get('accountSettings', 'User\Settings\Controllers\UserSettingsController@index')->name('userSettings.index');
    Route::get('accountGeneral', 'User\Settings\Controllers\AccountGeneralController@index')->name('userSettings.general');
    Route::post('accountGeneral', 'User\Settings\Controllers\AccountGeneralController@update');
    Route::get('changePassword', 'User\Settings\Controllers\ChangePasswordController@index')->name('userSettings.changePassword');
    Route::post('changePassword', 'User\Settings\Controllers\ChangePasswordController@changePassword');
});
Route::namespace('System')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::resource('menus', 'Menu\Controllers\MenuController');
        Route::resource('users', 'User\Controllers\UserController');
        Route::resource('roles', 'Role\Controllers\RoleController');
        Route::resource('permissions', 'Permission\Controllers\PermissionController');
        Route::resource('imports', 'Import\Import\Controllers\ImportController');
        Route::resource('notifications', 'Notification\Controllers\NotificationController');
        //user roles
        Route::get('userRoles/{id}','User\Controllers\UserRolesController@index')->name("admin-users.assing-roles");
        Route::post('userRoles/{id}','User\Controllers\UserRolesController@storeRoles');
        //user password reset from admin panel
        Route::get('userPasswordReset/{id}','User\Controllers\UserPasswordController@index')->name('admin-users.password-reset');
        Route::post('userPasswordReset','User\Controllers\UserPasswordController@changePassword');
        // MENU serialization
        Route::get('menuSerialization','Menu\Controllers\MenuSerializationController@index')->name('menu.serialization');
        Route::post('menuSerialization','Menu\Controllers\MenuSerializationController@serialize');
        //rolePermissions
        Route::get('rolePermissions/{id}','Role\Controllers\RolePermissionsController@index')->name('role.permissions');
        Route::post('rolePermissions/{id}','Role\Controllers\RolePermissionsController@update');
        //userPermissions
        Route::get('userPermissions/{id}','User\Controllers\UserPermissionsController@index')->name('user.permissions');
        Route::post('userPermissions/{id}','User\Controllers\UserPermissionsController@update');
        //files
        Route::get('file/upload/{table}/{id}/{unique?}','File\Controllers\FileController@create')->name('file.create');
        Route::post('file/upload','File\Controllers\FileController@upload')->name('file.create');
        Route::delete('files/{table}/{id}','File\Controllers\FileController@delete')->name('files.delete');
        //imports serialization
        Route::get('serializeImport/{id}','Import\Import\Controllers\ImportSerializationController@index')->name('import.serialization');
        Route::post('serializeImport/{id}','Import\Import\Controllers\ImportSerializationController@serialize')->name('import.serialization');
		// userNotifications
	    Route::get('calendar/getUserNotifications','Notification\Controllers\UserNotificationController@getData');
	    Route::get('getUserNotificationsList','Notification\Controllers\UserNotificationController@getNotifications');
	    //importFiles
	    Route::get('/getImports','Import\Import\Controllers\ImportViewController@index')->name('imports.show-all');
	    Route::get('/getImports/{view}','Import\Import\Controllers\ImportViewController@getView');

	    Route::get('importFile/{slug}','Import\ImportFile\Controllers\ImportFileController@index')->name('import-file.index');
	    Route::get('importFile/{slug}/upload','Import\ImportFile\Controllers\ImportFileUploadController@uploadView');
	    Route::post('importFile/upload','Import\ImportFile\Controllers\ImportFileUploadController@fileUpload');
	    Route::delete('importFiles/{id}','Import\ImportFile\Controllers\ImportFileController@destroy');
	    Route::get('importFiles/import/{id}','Import\ImportFile\Controllers\ImportFileController@importView');
	    Route::get('importTemps/{id}','Import\ImportTemp\Controllers\ImportTempController@checkFileStatus');
	    Route::get('importFile/process/{id}','Import\ImportFile\Controllers\ImportProcessController@index');
	    Route::get('importFile/progressBar/{id}','Import\ImportFile\Controllers\ImportProcessController@progressBar');
	    Route::get('importFiles/errorLog/{id}','Import\ImportFile\Controllers\ImportProcessController@getErrorLog');
	    Route::get('importFile/cleanErrors/{id}','Import\ImportFile\Controllers\ImportProcessController@cleanErrorLog');
        //import queues
        Route::resource('queuedImports','Import\Queue\Controllers\QueueImportController');
        Route::get('serializeQueuedImport/{id}','Import\Queue\Controllers\SerializeQueuedImportController@index');
        Route::post('serializeQueuedImport/{id}','Import\Queue\Controllers\SerializeQueuedImportController@serialize');
	    // SearchForm
        Route::get('search/{toFind}','Search\Controllers\SearchController');
    });
});
