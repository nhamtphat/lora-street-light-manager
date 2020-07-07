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
    return 'OK';
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
        Route::get('/', 'StreetController@getList')->name('list.get');
        Route::get('/add', 'StreetController@getAdd')->name('add.get');
        Route::post('/add', 'StreetController@postAdd')->name('add.post');
        Route::get('/{id}/edit', 'StreetController@getEdit')->name('edit.get');
        Route::post('/{id}/edit', 'StreetController@postEdit')->name('edit.post');
        Route::get('/{id}/delete', 'StreetController@getDelete')->name('delete.get');
        Route::get('/{id}/onoff', 'StreetController@getOnoff')->name('onoff.get');
        Route::get('/{id}/percent/{value}', 'StreetController@getPercent')->name('percent.get');
    });

    Route::name('schedule.')->prefix('/schedules')->group(function ()
    {
        Route::get('/', 'ScheduleController@getList')->name('list.get');
        Route::get('/add', 'ScheduleController@getAdd')->name('add.get');
        Route::post('/add', 'ScheduleController@postAdd')->name('add.post');
    });
});