<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('auth')->group(function(){
    Route::get('/', function(){
        return redirect()->route('bill.index');
    });
    Route::prefix('/member')->name('member.')->group(function () {
        Route::get('/', 'MemberController@index')->name('index');
        Route::get('/render', 'MemberController@render')->name('render');
        Route::post('/store', 'MemberController@store')->name('store');
        Route::get('/edit/{id}', 'MemberController@edit')->name('edit');
        Route::post('/update', 'MemberController@update')->name('update');
        Route::post('/update-status', 'MemberController@updateStatus')->name('updateStatus');
        Route::post('/delete', 'MemberController@delete')->name('delete');
    });

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', 'ProfileController@index')->name('index');
        Route::get('/render-profile', 'ProfileController@renderProfile')->name('renderProfile');
        Route::get('/render-password', 'ProfileController@renderPassword')->name('renderPassword');
        Route::post('/update', 'ProfileController@update')->name('update');
        Route::post('/updatePassword', 'ProfileController@updatePassword')->name('updatePassword');
    });

    Route::prefix('/customer')->name('customer.')->group(function () {
        Route::get('/', 'CustomerController@index')->name('index');
        Route::get('/render', 'CustomerController@render')->name('render');
        Route::post('/store', 'CustomerController@store')->name('store');
        Route::get('/edit/{id}', 'CustomerController@edit')->name('edit');
        Route::post('/update', 'CustomerController@update')->name('update');
        Route::post('/update-status', 'CustomerController@updateStatus')->name('updateStatus');
        Route::post('/delete', 'CustomerController@delete')->name('delete');
    });

    Route::prefix('/bandwidth')->name('bandwidth.')->group(function () {
        Route::get('/', 'CustomerBandwidthController@index')->name('index');
        Route::get('/render', 'CustomerBandwidthController@render')->name('render');
        Route::post('/store', 'CustomerBandwidthController@store')->name('store');
        Route::get('/edit/{id}', 'CustomerBandwidthController@edit')->name('edit');
        Route::post('/update', 'CustomerBandwidthController@update')->name('update');
        Route::post('/delete', 'CustomerBandwidthController@delete')->name('delete');
    });

    Route::prefix('/package')->name('package.')->group(function () {
        Route::get('/', 'PackageController@index')->name('index');
        Route::get('/render', 'PackageController@render')->name('render');
        Route::post('/store', 'PackageController@store')->name('store');
        Route::get('/edit/{id}', 'PackageController@edit')->name('edit');
        Route::post('/update', 'PackageController@update')->name('update');
        Route::post('/delete', 'PackageController@delete')->name('delete');
    });

    Route::prefix('/bill')->name('bill.')->group(function () {
        Route::get('/', 'BillController@index')->name('index');
        Route::get('/render/{month}/{year}', 'BillController@render')->name('render');
        Route::get('/additional/{month}/{year}', 'BillController@additional')->name('additional');
        Route::post('/store', 'BillController@store')->name('store');
        Route::post('/validate', 'BillController@validateBill')->name('validate');
        Route::post('/print', 'BillController@print')->name('print');
        Route::post('/print-all', 'BillController@printAll')->name('print.all');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
