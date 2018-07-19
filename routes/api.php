<?php

// use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api', 'as' => 'region.'], function () {
	/* 
		list districts of city have stores,
		data type: json
	*/
    Route::get('districts/{idCity}', 'RegionController@districtsHaveStoreJson')->name('districtsHaveStoreJson');

	/* 
		list all districts of city,
		data type: json
	*/
    Route::get('all-districts/{idCity}', 'RegionController@allDistricts')->name('allDistricts');

    /* 
    	list districts of city have stores,
    	data type: json html
    */
    Route::get('stores-by-district/{idDistrict}', 'RegionController@districtsHaveStoreHtml')->name('districtsHaveStoreHtml');

    /* 
    	list city have stores,
    	data type: json html
    */
    Route::get('stores-by-city/{idCity}', 'RegionController@citiesHaveStoreHtml')->name('citiesHaveStoreHtml');
});