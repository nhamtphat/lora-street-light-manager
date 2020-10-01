<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login','LoginController@getLogin')->name('guest.login.get');
Route::post('/login','LoginController@postLogin')->name('guest.login.post');

Route::get('/bao-loi/{id}', 'LampController@getReport'); 

Route::get('/ok', function ()
{
    \Debugbar::disable();
    // abort(500);
    echo 'OK';
});

Route::name('user.')->middleware('auth')->group(function() 
{
    Route::get('/logout','LoginController@getLogout')->name('logout.get');

    Route::get('/', function() {
        return redirect()->route('user.provinces.list');
    })->name('dashboard.index');

    Route::name('streets.')->prefix('/streets')->group(function ()
    {
        Route::get('/', 'DashboardController@getView')->name('index');
        Route::post('/', 'StreetController@store')->name('store');
        Route::get('/list', 'StreetController@list')->name('list');
        Route::get('/create', 'StreetController@create')->name('create');
        Route::get('/{street}', 'StreetController@show')->name('show');
        Route::patch('/{street}', 'StreetController@update')->name('update');
        Route::get('/{street}/edit', 'StreetController@edit')->name('edit');
        Route::get('/{street}/delete', 'StreetController@delete')->name('delete');
        Route::get('/{street}/reset', 'StreetController@reset')->name('reset');
    });

    Route::name('schedules.')->prefix('/schedules')->group(function ()
    {
        Route::get('/', 'ScheduleController@list')->name('list');
        Route::post('/', 'ScheduleController@store')->name('store');
        Route::get('/create', 'ScheduleController@create')->name('create');
        Route::patch('/{schedule}', 'ScheduleController@update')->name('update');
        Route::get('/{schedule}/edit', 'ScheduleController@edit')->name('edit');
        Route::get('/{schedule}/delete', 'ScheduleController@delete')->name('delete');
    });
    
    Route::name('lamp.')->prefix('/lamps')->group(function ()
    {
        Route::get('/{id}/reset', 'LampController@reset')->name('reset');
        Route::get('/{id}/on', 'LampController@turnOn')->name('turn.on');
        Route::get('/{id}/off', 'LampController@turnOff')->name('turn.off');
    });

    Route::name('provinces.')->prefix('provinces')->group(function ()
    {
        Route::get('/', 'ProvinceController@list')->name('list');
        Route::get('/on-all', 'ProvinceController@turnOnAll')->name('turn.onall');
        Route::get('/off-all', 'ProvinceController@turnOffAll')->name('turn.offall');
        Route::get('/turn-max', 'ProvinceController@turnMaxAll')->name('turn.maxall');
        Route::get('/turn-mid', 'ProvinceController@turnMidAll')->name('turn.midall');
        Route::get('/{province}', 'ProvinceController@show')->name('show');
        Route::get('/{province}/on', 'ProvinceController@turnOn')->name('turn.on');
        Route::get('/{province}/off', 'ProvinceController@turnOff')->name('turn.off');
    });

    Route::prefix('districts')->name('districts.')->group(function ()
    {
        Route::get('/', 'DistrictController@list')->name('list');
        Route::get('/{district}/lamps', 'DistrictController@getListOfLamps')->name('listoflamps.get');
    });

    Route::prefix('wards')->name('wards.')->group(function ()
    {
        Route::get('/', 'WardController@list')->name('list');
        Route::get('/{ward}/lamps', 'WardController@getListOfLamps')->name('listoflamps.get');
    });
});