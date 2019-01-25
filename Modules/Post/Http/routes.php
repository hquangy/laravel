<?php

Route::group([
	'middleware' => 'web',
	'namespace' => 'Modules\Post\Http\Controllers'
], function()
{

	# section BE
	Route::group([
		'middleware' => 'auth',
		'as' => 'be.',
		'prefix' => 'admin',
	], function () {

		# post
		Route::group([
			'prefix' => 'post',
			'as' => 'post.',
		], function() {
    		Route::get('/', 'PostController@index')->name('index');
		});
	});

	
});
