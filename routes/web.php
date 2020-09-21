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
    Route::get('/checkauth', function ()
    {
        return 'Loged in successed!';
    }); 
    Route::get('/logout','LoginController@getLogout')->name('logout.get');
    Route::get('/', 'DashboardController@getView')->name('dashboard.view.get');

    Route::name('street.')->prefix('/streets')->group(function ()
    {
        Route::get('/', 'StreetController@getList')->name('list');
        Route::get('/add', 'StreetController@getAdd')->name('add.get');
        Route::post('/add', 'StreetController@postAdd')->name('add.post');
        Route::get('/{id}/edit', 'StreetController@getEdit')->name('edit.get');
        Route::post('/{id}/edit', 'StreetController@postEdit')->name('edit.post');
        Route::get('/{id}/delete', 'StreetController@getDelete')->name('delete.get');
        Route::get('/{id}/reset', 'StreetController@getReset')->name('reset.get');
        Route::get('/{id}', 'StreetController@getView')->name('view.get');
    });

    Route::name('schedule.')->prefix('/schedules')->group(function ()
    {
        Route::get('/', 'ScheduleController@getList')->name('list');
        Route::get('/add', 'ScheduleController@getAdd')->name('add.get');
        Route::post('/add', 'ScheduleController@postAdd')->name('add.post');
        Route::get('/edit/{id}', 'ScheduleController@getEdit')->name('edit.get');
        Route::post('/edit/{id}', 'ScheduleController@postEdit')->name('edit.post');
        Route::get('/delete/{id}', 'ScheduleController@getDelete')->name('delete.get');
    });
    
    Route::name('lamp.')->prefix('/lamps')->group(function ()
    {
        Route::get('/{id}/reset', 'LampController@getReset')->name('reset.get');
        Route::get('/{id}/on', 'LampController@turnOn')->name('on.get');
        Route::get('/{id}/off', 'LampController@turnOff')->name('off.get');
    });

    Route::prefix('provinces')->name('provinces.')->group(function ()
    {
        Route::get('/', 'ProvinceController@list')->name('list');
        Route::get('/{province}/lamps', 'ProvinceController@getListOfLamps')->name('lamps');
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