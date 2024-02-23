<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [BlogController::class, 'index'])->name('welcome');
Route::get('/blog/posts/{id}', [BlogController::class, 'show'])->name('blog.posts.show');
Route::get('/blog/posts/search', [BlogController::class, 'search'])->name('blog.posts.search');

Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class);
Route::post('/posts/{id}/comments', [PostController::class, 'addComment'])->name('posts.comments.store');

require __DIR__ . '/auth.php';
