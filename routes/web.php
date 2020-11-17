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
Auth::routes();

Route::get('/', 'JobsController@index');
Route::get('/test', function(){
    return "hallo";
});

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/users', 'UsersController@index');

Route::resource('jobs', 'JobsController');

// Email moderation link
Route::get('moderate/{id}', 'JobsController@moderate');
Route::get('spam/{id}', 'JobsController@spam');
