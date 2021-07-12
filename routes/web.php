<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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
Auth::routes();

// Routes for passwords
Route::get('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot.password.reset');

// Route for homepage (invokable)
Route::get('/', HomeController::class)->name('home');

// Routes for users
Route::resource('users', UserController::class);

// Routes for admin
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', AdminController::class)->name('panel');
    Route::get('/users/index/', [AdminUserController::class, 'index'])->name('users.index');
    Route::resource('/users', AdminUserController::class)->except(['index']);
    Route::post('/users/search', [AdminUserController::class, 'search'])->name('users.search');
});


// Routes for errors
Route::get('/403', function () {
    return abort(403);
});