<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // inserire eventualmente (relativo Store IMG)

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/index', 'HomeController@index')->name('guest.index');
//
// Route::get('/appartamento/{id}', 'HomeController@index')->name('show.home');


Auth::routes();

Route::get('/upr/homes', 'HomeController@index')->name('homes'); // commento prova

Route::namespace('Upr')
->name('upr.')
->prefix('upr')
->middleware('auth')
->group(function (){
    Route::resource('homes', 'HomeController');
});

Route::get('/guest/homes', 'GuestController@index')->name('guest.index');

Route::namespace('Guest')
->name('guest.')
->prefix('guest')
->group(function (){
    Route::resource('homes', 'GuestController');
});
