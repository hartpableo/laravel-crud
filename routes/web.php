<?php

use App\Http\Controllers\PostController;
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

Route::get('/posts/trash', [PostController::class, 'trashed'])->name('posts.trashed');
Route::get('/post/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/post/{post}/force_destroy', [PostController::class, 'force_destroy'])->name('posts.force_destroy');

Route::resource('posts', PostController::class);