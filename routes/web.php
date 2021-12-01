<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('/')->namespace('Main')->middleware('auth')->group(function () {
    // Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/', function(){
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/chart', 'DashboardController@chart')->name('chart');
    Route::post('/chart', 'DashboardController@renderChart')->name('render.chart');
    Route::post('/export', 'DashboardController@export')->name('export');
});
Route::prefix('/admin')->middleware('auth')->namespace('Admin')->name('admin.')->group(function(){
    Route::prefix('/ticket')->name('ticket.')->group(function () {
        Route::get('/', 'TicketController@index')->name('index');
        Route::get('/render', 'TicketController@render')->name('render');
        Route::post('/store', 'TicketController@store')->name('store');
        Route::get('/edit/{id}', 'TicketController@edit')->name('edit');
        Route::post('/update', 'TicketController@update')->name('update');
        Route::post('/delete', 'TicketController@delete')->name('delete');
    });

    Route::prefix('/community')->name('community.')->group(function () {
        Route::get('/', 'CommunityController@index')->name('index');
        Route::get('/render', 'CommunityController@render')->name('render');
        Route::post('/change-status', 'CommunityController@changeStatus')->name('change.status');
    });

    Route::prefix('/sale')->name('sale.')->group(function () {
        Route::get('/', 'SaleController@index')->name('index');
        Route::get('/render', 'SaleController@render')->name('render');
        Route::post('/store', 'SaleController@store')->name('store');
        Route::get('/edit/{id}', 'SaleController@edit')->name('edit');
        Route::post('/update', 'SaleController@update')->name('update');
        Route::post('/delete', 'SaleController@delete')->name('delete');

        Route::get('/ticketPrice/{id}', 'SaleController@ticketPrice')->name('ticket.price');
    });
});

// MANAGER
Route::prefix('/manager')->middleware('auth')->namespace('Manager')->name('manager.')->group(function(){
    Route::prefix('/staff')->name('staff.')->group(function () {
        Route::get('/', 'StaffController@index')->name('index');
        Route::get('/render', 'StaffController@render')->name('render');
        Route::post('/store', 'StaffController@store')->name('store');
        Route::get('/edit/{id}', 'StaffController@edit')->name('edit');
        Route::post('/update', 'StaffController@update')->name('update');
        Route::post('/delete', 'StaffController@delete')->name('delete');
        Route::post('/change-status', 'StaffController@changeStatus')->name('change.status');
    });
});

// COMMUNITY
Route::prefix('/community')->middleware('guest')->namespace('Community')->name('community.')->group(function(){
    Route::post('/register', 'CommunityController@register')->name('register');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
