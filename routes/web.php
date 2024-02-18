<?php

use App\Http\Controllers\GuestLoginController;
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
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

Route::get('/guest-login', [GuestLoginController::class, 'login'])->name('guest-login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');
});


