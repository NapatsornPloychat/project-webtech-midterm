<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('posts.index');
});

Route::get('/dashboard',[AdminController::class,'dashBoard'])->name('dashBoard');

require __DIR__.'/auth.php';

Route::post('/posts/track',[\App\Http\Controllers\PostController::class,'postTracker'])->name('posts.tracker');

Route::post('/posts/{post}/comments', [\App\Http\Controllers\PostController::class, 'storeComment'])
    ->name('posts.comments.store');

Route::post('/posts/{post}', [\App\Http\Controllers\PostController::class, 'votePost'])
    ->name('posts.vote');


Route::resource('/posts', \App\Http\Controllers\PostController::class);


Route::resource('/tags', \App\Http\Controllers\TagController::class);
Route::resource('/admin',AdminController::class);
