<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // inserire eventualmente (relativo Store IMG)
use Braintree\Gateway;

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
    Route::get('sponsors/{id}', 'SponsorController@create')->name('sponsors.create');
    Route::post('sponsors/{id}', 'SponsorController@store')->name('sponsors.store');
    Route::delete('messages/{message}', 'MessageController@destroy')->name('messages.destroy');
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
    Route::post('homes/search', 'GuestController@search')->name('homes.search');
});

// Route::get('/', function () {
//
//
// });

// Route::get('upr/homes/sponsor', function () {
//
//
// });

// Route::post('/checkout', function (Request $request) {
//
//     $gateway = new Braintree\Gateway([
//         'environment' => config('services.braintree.environment'),
//         'merchantId' => config('services.braintree.merchantId'),
//         'publicKey' => config('services.braintree.publicKey'),
//         'privateKey' => config('services.braintree.privateKey')
//     ]);
//
//     $amount = $request->amount;
//     $nonce = $request->payment_method_nonce;
//
//     $result = $gateway->transaction()->sale([
//         'amount' => $amount,
//         'paymentMethodNonce' => $nonce,
//         // 'customer' => [
//         //     'firstName' => 'Luca',
//         //     'lastName' => 'Giannino',
//         //     'email' => 'gianni@gmail.com'
//         // ],
//         'options' => [
//             'submitForSettlement' => true
//         ]
//     ]);
//
//     if ($result->success) {
//         $transaction = $result->transaction;
//         // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
//         return back()->with('success_message', 'Transazione eseguita correttamente.');
//     } else {
//         $errorString = "";
//
//         foreach ($result->errors->deepAll() as $error) {
//             $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
//         }
//
//         // $_SESSION["errors"] = $errorString;
//         // header("Location: " . $baseUrl . "index.php");
//
//         return back()->withErrors('An error occurred with the message: '. $result->message);
//     }
// });
