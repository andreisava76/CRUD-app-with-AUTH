<?php

use App\Http\Controllers\Auth\VerifyMobileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can create web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(["verify" => true]);

Route::group(["prefix" => "user", "as" => "user.", "middleware" => ["auth","verify.mobile"], "controller" => UserController::class], function () {
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create')->middleware('can:admin');
    Route::post('/', 'store')->name('store')->middleware('can:admin');
    Route::delete('/', 'destroy')->name('destroy')->middleware('can:admin');
    Route::patch('/', 'update')->name('update')->middleware('can:admin');
});

Route::get('/', function () {
    return Redirect::to(RouteServiceProvider::HOME);
});

Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to(RouteServiceProvider::HOME);
});

Route::get('auth/google', [GoogleController::class, 'google_page'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'google_callback']);

Route::post('verify-mobile', [VerifyMobileController::class, '__invoke'])
    ->middleware(['throttle:6,1'])
    ->name('verification.verify-mobile');

Route::view('verify-mobile','auth.verify-mobile')->name('verification-mobile.notice');
