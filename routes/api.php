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

Route::group(['middleware' => 'api'], static function ( $router ) { 
    //Unprotected
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    //Protected
    Route::group(['middleware' => 'jwt.verify'], static function( $router ) {
        Route::get('detail', 'UserController@detail');

        //Admin
        Route::group(['middleware' => 'role:admin' , 'prefix' => 'admin/tickets'], static function ($router) {
            Route::get('/{id?}' , 'TicketController@get');
            Route::post('/', 'TicketController@post');
            Route::put('/{id}', 'TicketController@update');
            Route::delete('/{id}', 'TicketController@delete');
        });
        //User
        Route::group(['middleware' => 'role:user', 'prefix' => 'user/tickets'], static function ($router) {
            Route::get('/{id?}', 'TicketController@getByUser');
            Route::post('/{id}/take', 'TicketController@take');
        });
    });
    
});

