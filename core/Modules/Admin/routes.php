<?php

use Illuminate\Support\Facades\Route;

Route::group(
	[
		'prefix' 	=> 'admin',
		'middleware' => ['web'],
		'namespace'	=> 'Core\\Modules\\Admin\\Controllers'
	], function() {
        Route::get('/', 'DashboardController@index');
		Route::group([
			'prefix' => 'auth',
		],function () {
			Route::get('/', 'Auth\AuthController@index');
		});
    }
);