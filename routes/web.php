<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('register', 'RegistrationController@create')->name('register');
Route::post('/register', 'RegistrationController@store');

use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestEmail;

Route::get('/send-email', function () {
    Mail::to('example@email.com')->send(new MyTestEmail());
    return 'Email sent!';
});

