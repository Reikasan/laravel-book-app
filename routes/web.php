<?php

use App\Http\Controllers\GuestLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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
        return view('pages.welcome');
    })->name('welcome');

Route::get('/guest-login', [GuestLoginController::class, 'login'])->name('guest-login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.index');
    })->name('home');

    Route::group(['prefix' =>'books'], function() {
        Route::resource('/', BookController::class);
        Route::post('/search', [BookController::class, 'searchByApi'])->name('books.searchByApi');
        Route::post('/{title}', [BookController::class, 'showFetchedBook'])->name('books.showFetchedBook');
    });
});


