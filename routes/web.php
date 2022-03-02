<?php

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;

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

Route::group(['middleware' => ['xss.sanitizer']], function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'createUser']);

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::post('/logout', [LogoutController::class, 'deauthenticate'])->name('logout');

Route::get('/admin/activity', [ActivityController::class, 'index'])->name('activities');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blogs/view/{blogId}', [BlogController::class, 'viewBlog'])->name('blog');

Route::get('/profile/view/{userId}', [ProfileController::class, 'index'])->name('profile');

Route::group(['middleware' => ['auth', 'xss.sanitizer']], function () {
    Route::get('/blogs/create', [BlogController::class, 'createBlog'])->name('createBlog');
    Route::post('/blogs/create', [BlogController::class, 'store']);
    Route::get('/blogs/edit/{blogId}', [BlogController::class, 'editBlog'])->name('editBlog');
    Route::patch('/blogs/edit/{blogId}', [BlogController::class, 'patch']);
    Route::delete('/blogs/delete/{post}', [BlogController::class, 'destroy'])->name('destroyBlog');

    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('editProfile');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/profile/update-info', [ProfileController::class, 'updateBasicInfo'])->name('updateBasicInfo');
});

Route::get('/', function () {
    return view('index');
})->name('home');
