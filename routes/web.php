<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;

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
    return view('auth.login');
});

Auth::routes();

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// users
Route::resource('users', UserController::class);

// categories
Route::get('/ajax/categories/search', [CategoryController::class, 'ajaxSearch']);
Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
Route::get('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
Route::delete('/categories/{category}/delete-permanent', [CategoryController::class, 'deletePermanent'])->name('categories.delete-permanent');
Route::resource('categories', CategoryController::class);

// books
Route::get('/books/trash', [BookController::class, 'trash'])->name('books.trash');
Route::get('/books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
Route::delete('/books/{category}/delete-permanent', [BookController::class, 'deletePermanent'])->name('books.delete-permanent');
Route::resource('books', BookController::class);

// Order
Route::resource('orders', OrderController::class);

