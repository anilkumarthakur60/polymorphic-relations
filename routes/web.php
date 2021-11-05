<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('posts/newpost', [PostController::class, 'mediapost'])->name('posts.newpost');
Route::get('posts/newpost', [PostController::class, 'getpost'])->name('posts.mediapost');
Route::resource('posts', PostController::class);
Route::resource('videos', VideoController::class);
Route::resource('images', ImageController::class);
Route::get('categories/dropzone', [CategoryController::class, 'dropzoneindex'])->name('categories.dropzoneindex');
Route::post('categories/dropzone', [CategoryController::class, 'dropzonestore'])->name('categories.dropzonestore');
Route::resource('categories', CategoryController::class);