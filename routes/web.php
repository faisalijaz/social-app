<?php

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

Route::group(['middleware' => ['auth']], function () {

    #get all posts from a user
    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts');

    Route::group(['prefix' => '/post'], function () {

        Route::get('/show/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('post.show');
        Route::get('/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
        Route::post('/', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');

        Route::group(['middleware' => ['post_modification']], function () {
            Route::get('/edit/{id}', [\App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete');
        });
    });

    Route::group(['prefix' => '/post-comment'], function () {
        Route::post('/', [\App\Http\Controllers\PostCommentController::class, 'comment'])->name('post.comment');
    });
});
