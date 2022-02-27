<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
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

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/profile/update-bio', [ProfileController::class, 'updateBio'])->name('updateBio');
});

Route::post('/logout', [LogoutController::class, 'deauthenticate'])->name('logout');

Route::get('/', function () {
    return view('index');
})->name('home');
