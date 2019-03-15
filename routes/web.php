<?php
# Test
Route::group(['namespace' => 'Test', 'as' => 'test.', 'prefix'=>'test'], function () {
	// Route::get('curlLargeFile', 'CurlController@index');
});

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {

});

Route::group([
	'namespace' => 'Backend',
	'as' => 'backend.',
	'prefix'=>'admin',
	// 'middleware' => ['auth'], 
], function () {
	Route::get('excelGoogleMerchant', 'ExcelController@excelGoogleMerchant');
	Route::get('excelFace', 'ExcelController@excelFace');

	Route::get('getPage', 'CurlController@getPage');
});

// # Frontend
// Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
// 	Route::get('vi', 'RedirectController@home');
// 	Route::get('thucdon', 'RedirectController@thuc_don');
// 	Route::get('vi-mon-doc-chieu', 'RedirectController@thuc_don');
// 	Route::get('vi/fastfood-huong-vi-viet', 'RedirectController@home');
// 	Route::get('en/contact-us', 'RedirectController@home');
// 	Route::get('vi/tuyen_dung', 'RedirectController@tuyen_dung');
// 	Route::get('vi/{slug}', 'RedirectController@thuc_don');
// 	Route::get('vi/{slug}/{slug1}', 'RedirectController@thuc_don');
// 	Route::get('vi/{slug}/{slug1}/{slug2}', 'RedirectController@thuc_don');
// 	Route::get('en/{slug}', 'RedirectController@thuc_don');
// 	Route::get('en/{slug}/{slug1}', 'RedirectController@thuc_don');
// 	Route::get('en/{slug}/{slug1}/{slug2}', 'RedirectController@thuc_don');

//     Route::get('/', 'QuanAnController@index')->name('trang_chu');
//     Route::get('/gioi-thieu', 'QuanAnController@gioi_thieu')->name('gioi_thieu');
//     Route::get('/thuc-don', 'QuanAnController@thuc_don')->name('thuc_don');
//     Route::get('/uu-dai', 'QuanAnController@uu_dai')->name('uu_dai');
//     Route::get('/chi-nhanh', 'QuanAnController@chi_nhanh')->name('chi_nhanh');
//     Route::get('/thanh-vien', 'QuanAnController@thanh_vien')->name('thanh_vien');
//     Route::get('/lien-he', 'QuanAnController@lien_he')->name('lien_he');
//     Route::post('/lien-he', 'QuanAnController@postLienHe')->name('postLienHe');
//     Route::get('/tuyen-dung', 'QuanAnController@tuyen_dung')->name('tuyen_dung');
//     Route::get('/huong-dan-mua-hang', 'QuanAnController@huong_dan_mua_hang')->name('huong_dan_mua_hang');
//     Route::get('/uu-dai/{slug}', 'QuanAnController@uu_dai_detail')->name('uu_dai_detail');
//     Route::get('/tin-tuc/{slug}', 'QuanAnController@tin_tuc_detail')->name('tin_tuc_detail');
//     Route::get('/khach-hang/{slug}', 'QuanAnController@cam_nhan_detail')->name('cam_nhan_detail');
// });

// # Upload
// Route::group(['namespace' => 'Upload', 'as' => 'upload.'], function () {
// 	Route::get('/excel', 'UploadController@excel')->name('excel');
// });

// # Auth
// Route::group([
//     'namespace' => 'Auth',
// ], function () {
//     Route::get('/login', 'AuthController@loginForm')->name('loginForm');
//     Route::post('/login', 'AuthController@login')->name('login');
//     Route::post('/logout', 'AuthController@logout')->name('logout');
// });

// # BE
// Route::group([
//     'prefix' => 'admin',
//     'namespace' => 'Backend',
//     'as' => 'be.',
//     'middleware' => ['auth'],
// ], function () {

// 	# Dashboard
// 	Route::group([
// 	    'prefix' => 'dashboard',
// 	    'as' => 'dashboard.',
// 	], function () {
// 	    Route::get('/', 'DashboardController@index')->name('index');
// 	});

// 	# Blog
// 	Route::group([
// 	    'prefix' => 'blog',
// 	    'as' => 'blog.',
// 	], function () {
// 	    Route::get('/', 'BlogController@index')->name('index');
// 	    Route::get('/create', 'BlogController@create')->name('create');
// 	    Route::post('/create', 'BlogController@store')->name('store');
// 	    Route::get('/edit/{id}', 'BlogController@edit')->name('edit');
// 	    Route::post('/update/{id}', 'BlogController@update')->name('update');
// 	    Route::post('/delete/{id}', 'BlogController@destroy')->name('delete');
// 	});

// 	# Page
// 	Route::group([
// 	    'prefix' => 'page',
// 	    'as' => 'page.',
// 	], function () {
// 	    Route::get('/', 'PageController@index')->name('index');
// 	    Route::get('/create', 'PageController@create')->name('create');
// 	    Route::post('/create', 'PageController@store')->name('store');
// 	    Route::get('/edit/{id}', 'PageController@edit')->name('edit');
// 	    Route::post('/update/{id}', 'PageController@update')->name('update');
// 	    Route::post('/delete/{id}', 'PageController@destroy')->name('delete');
// 	});

// 	# Category
// 	Route::group([
// 	    'prefix' => 'category',
// 	    'as' => 'category.',
// 	], function () {
// 	    Route::get('/', 'CategoryController@index')->name('index');
// 	    Route::get('/create', 'CategoryController@create')->name('create');
// 	    Route::post('/create', 'CategoryController@store')->name('store');
// 	    Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
// 	    Route::post('/update/{id}', 'CategoryController@update')->name('update');
// 	    Route::post('/delete/{id}', 'CategoryController@destroy')->name('delete');
// 	});

// 	# Product
// 	Route::group([
// 	    'prefix' => 'product',
// 	    'as' => 'product.',
// 	], function () {
// 	    Route::get('/', 'ProductController@index')->name('index');
// 	    Route::get('/create', 'ProductController@create')->name('create');
// 	    Route::post('/create', 'ProductController@store')->name('store');
// 	    Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
// 	    Route::post('/update/{id}', 'ProductController@update')->name('update');
// 	    Route::post('/delete/{id}', 'ProductController@destroy')->name('delete');
// 	    Route::post('/upload/excel', 'ProductController@excelUpload')->name('excelUpload');
// 	});

// 	# Store
// 	Route::group([
// 	    'prefix' => 'store',
// 	    'as' => 'store.',
// 	], function () {
// 	    Route::get('/', 'StoreController@index')->name('index');
// 	    Route::get('/create', 'StoreController@create')->name('create');
// 	    Route::post('/create', 'StoreController@store')->name('store');
// 	    Route::get('/edit/{id}', 'StoreController@edit')->name('edit');
// 	    Route::post('/update/{id}', 'StoreController@update')->name('update');
// 	    Route::post('/delete/{id}', 'StoreController@destroy')->name('delete');
// 	    Route::post('/upload/excel', 'StoreController@excelUpload')->name('excelUpload');
// 	});
// });