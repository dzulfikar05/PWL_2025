<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register-api', RegisterController::class)->name('register-api');
Route::post('/login-api', LoginController::class)->name('login-api');
Route::post('/logout-api', LogoutController::class)->name('logout-api');

Route::middleware('jwt.auth')->get('/user-api', function (Request $request) {
    return auth()->user();
})->name('user-api');
