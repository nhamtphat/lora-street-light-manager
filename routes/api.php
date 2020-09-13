<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/getdistricts/{province_id}', 'API\SubdivisionAPI@getDistricts');
Route::get('/getwards/{district_id}', 'API\SubdivisionAPI@getWards');

Route::name('street.')->prefix('/streets')->group(function ()
{
    Route::get('/{id}/on', 'API\StreetController@setOn')->name('on.set');
    Route::get('/{id}/off', 'API\StreetController@setOff')->name('off.set');
    Route::get('/{id}/level/{value}', 'API\StreetController@setLevel')->name('level.set');
    Route::get('/errorlamps', 'API\StreetController@getListOfErrorLamps')->name('lerrorlamps.get');
});
