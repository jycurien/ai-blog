<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

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
    $posts = Post::with('tags')->take(4)->latest()->get();
    return view('home.index', ['posts' => $posts]);
})->name('home');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('post/{id}', [PostController::class, 'show'])->name('posts.show');
Route::view('about', 'about.index')->name('about');


Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tags', AdminTagController::class);
    Route::resource('posts', AdminPostController::class);
});

require __DIR__.'/auth.php';
