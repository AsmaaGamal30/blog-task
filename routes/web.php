<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/search',  [PostController::class, 'search'])->name('posts.search');


Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('post-login');;
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('post-register');
});
Route::middleware(['auth'])->controller(AuthController::class)->group(function () {
    Route::get('profile', 'showProfile')->name('profile');
    Route::get('profile/edit', 'editProfile')->name('profile.edit');
    Route::put('profile', 'updateProfile')->name('profile.update');
    Route::post('logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->controller(PostController::class)->group(function () {
    Route::get('post/{id}', 'show')->name('post.show')->withoutMiddleware(['auth']);
    Route::get('/profile/posts', 'allPosts')->name('my-posts');
    Route::view('/create', 'blog.create')->name('post.create');
    Route::post('post/store', 'store')->name('post.store');
    Route::get('post/edite/{id}', 'edit')->name('post.edit');
    route::put('post/update/{id}', 'update')->name('post.update');
    route::delete('post/delete/{id}', 'destroy')->name('post.delete');
});

Route::post('/comments', [CommentController::class, 'store'])->middleware(['auth'])->name('comments.store');
