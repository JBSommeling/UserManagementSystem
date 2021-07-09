<?php

use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Email route
Route::post('/email/validate', EmailController::class)->name('email.validate');

// Password routes
Route::post('/password/compare', [ForgotPasswordController::class, 'compare'])->name('password.answer.compare');
Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');