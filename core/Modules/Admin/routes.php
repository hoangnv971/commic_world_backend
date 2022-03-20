<?php

use Illuminate\Support\Facades\Route;

Route::group(
	[
		'prefix' 	=> 'admin',
		'middleware' => ['web'],
		'namespace'	=> 'Core\\Modules\\Admin\\Controllers'
	], function() {
        Route::get('/', 'DashboardController@index')->name('dashboard');
		Route::group([
			'prefix' => 'auth',
		],function () {
			Route::get('/', 'Auth\ManagerController@index')->name('manager.index');
		});
    }
);