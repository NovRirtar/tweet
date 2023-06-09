<?php

use App\Http\Controllers\BookmarkController;
use App\Models\User;
use App\Models\Tweets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikeController;



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

Route::get('/', [TweetsController::class, 'index'])->middleware(['auth'])->name('home');

Route::post('/users/{user:username}/follow', [FollowController::class, 'store'])->middleware(['auth']);


Route::get('/register', function(){
    return view('register');
});

Route::get('/bookmark', [BookmarkController::class, 'show'])->middleware(['auth'])->name('bookmark');

Route::post('/bookmark', [BookmarkController::class, 'store'])->middleware('auth');
Route::delete('/bookmark/{id}', [BookmarkController::class, 'destroy'])->middleware('auth');


Route::get('/explore', function() {
    return view('explore');
})->middleware(['auth'])->name('explore');

Route::get('/notification', function() {
    return view('notification');
})->middleware(['auth'])->name('notification');

Route::get('/message', function() {
    return view('message');
})->middleware(['auth'])->name('message');

Route::get('/li', function() {
    return view('list');
})->middleware(['auth'])->name('list');

Route::get('/edit', function() {
    return view('edit');
})->middleware(['auth'])->name('edit');

Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
Route::post('/comment', [CommentsController::class, 'store'])->middleware(['auth']);

Route::get('/list', [ProfileController::class, 'allUsers'])->middleware(['auth']);

Route::patch('/profile', [ProfileController::class, 'update'])->middleware(['auth']);

Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware(['auth']);

Route::post('/upload', [TweetsController::class, 'store'])->name('upload');


Route::post('/', [TweetsController::class, 'store']);
// Route::delete('/comments/{id}', [CommentsController::class, 'delete'])->name('comments.delete');
// Route::put('/comments/{id}', [CommentsController::class, 'update'])->name('comments.update');

Route::post('/tweets/{id}/pin', 'TweetsController@pinPost');
Route::post('/tweets/{id}/delete', 'TweetsController@deletePost');
Route::post('/tweets/{id}/edit', 'TweetsController@editPost');

Route::post('/register', [RegisterController::class, 'signin']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/login', function(){
    return view('login');
})->name('login');

 Route::get('/logout', [LoginController::class, 'logout']);


 Route::get('/tweet/{id}', [TweetsController::class, 'show'])->middleware(['auth']);
