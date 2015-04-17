<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Web interface
Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'HomeController@index');
    Route::get('/tickets', ['as' => 'tickets', 'uses' => 'TicketController@index']);

    //Bak
    Route::get('/overview', ['as' => 'overview', 'uses' => 'BakController@index']);
    Route::get('/bak/{id}/view', ['as' => 'bak.view', 'uses' => 'BakController@view']);
    Route::get('/bak/{id}/edit', ['as' => 'bak.edit', 'uses' => 'BakController@edit']);
    Route::get('/bak/{id}/closetrunks', ['as' => 'bak.closetrunks', 'uses' => 'BakController@closeTrunks']);
    Route::post('/bak/{id}/edit', 'BakController@update');

    //Trunk
    Route::get('/trunk/{id}/edit', ['as' => 'trunk.edit', 'uses' => 'TrunkController@edit']);
    Route::post('/trunk/{id}/edit', 'TrunkController@update');

});

Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@authenticate');

//Api
Route::post('/api/v1/setstatus', 'ApiController@setStatus');
Route::post('/api/v1/getstatus', 'ApiController@getStatus');
Route::post('/api/v1/checkticket', 'ApiController@checkTicket');
Route::post('/api/v1/gettrunkstate', 'ApiController@getTrunkState');
Route::post('/api/v1/settrunkstate', 'ApiController@setTrunkState');
