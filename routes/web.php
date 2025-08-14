<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboarduserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\KomentarController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', fn () => view('admin.newBook'))->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');

    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard');
    Route::get('/book/{id}', [DashboardUserController::class, 'show'])->name('book.show');

});

Route::post('/admin/books/mass-destroy', [BookController::class, 'massDestroy'])->name('admin.books.massDestroy');


Route::middleware('auth')->group(function () {
    Route::get('/books/{book_id}/comments', [KomentarController::class, 'index']);
    Route::post('/books/{book_id}/comments', [KomentarController::class, 'store']);
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy']);
});

