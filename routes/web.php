<?php

use App\Http\Controllers\GuestLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;

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
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('books', BookController::class);
    Route::post('books/search', [BookController::class, 'searchByApi'])->name('books.searchByApi');
    Route::post('books/{title}', [BookController::class, 'showFetchedBook'])->name('books.showFetchedBook');

    Route::resource('reviews', ReviewController::class);
    Route::post('reviews/{title}', [ReviewController::class, 'createFromApi'])->name('reviews.createFromApi');
});


