<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
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
    // Mail::to('sameh.dheir1@gmail.com')->send(new TestMail());
    return view('welcome');
});

Route::get('/test', function () {
    Mail::to('dheir551@gmail.com')->send(new TestMail());
});
