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

// rotte UPR
Route::namespace('Upr')
->name('upr.')
->prefix('upr')
->middleware('auth')
->group(function (){
    Route::resource('homes', 'HomeController');
    Route::delete('messages/{message}', 'MessageController@destroy')->name('messages.destroy');
});

// rotte GUEST
Route::namespace('Guest')
->name('guest.')
->prefix('guest')
->group(function (){
    Route::get('homes', 'GuestController@index')->name('homes.index');
    Route::get('homes/{home}', 'GuestController@show')->name('homes.show');
    Route::post('messages', 'MessageController@store')->name('messages.store');
    Route::post('stats/{home_id}', 'StatController@store')->name('stats.store');
});
