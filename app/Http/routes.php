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

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'HomeController@index');
    Route::get('/tickets', ['as' => 'tickets', 'uses' => 'TicketController@index']);

    //Bak
    Route::get('/overview', ['as' => 'overview', 'uses' => 'BakController@index']);
    Route::get('/bak/{id}/view', ['as' => 'bak.view', 'uses' => 'BakController@view']);
    Route::get('/bak/{id}/edit', ['as' => 'bak.edit', 'uses' => 'BakController@edit']);
    Route::post('/bak/{id}/edit', 'BakController@handleEdit');

});

Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@authenticate');

//Api
Route::post('/api/setstatus', 'ApiController@setStatus');
Route::post('/api/checkticket', 'ApiController@checkTicket');
