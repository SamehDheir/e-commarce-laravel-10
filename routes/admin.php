<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware grup. Make something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::view('/login', 'back.pages.admin.auth.login')->name('login');
        Route::post('/login_handler',[AdminController::class, 'loginHandler'])->name('login_handler');
        // Route::get('/forget-password', [AdminController::class, 'forgetPassword'])->name('forgetPassword');
    });
    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/home', 'back.pages.admin.home')->name('home');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
