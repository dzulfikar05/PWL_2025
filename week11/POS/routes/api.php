<?php

use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
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
Route::post('/register1', RegisterController::class)->name('register1');
Route::post('/login-api', LoginController::class)->name('login-api');
Route::post('/logout-api', LogoutController::class)->name('logout-api');

Route::middleware('jwt.auth')->get('/user-api', function (Request $request) {
    return auth()->user();
})->name('user-api');


Route::get('levels', [LevelController::class, 'index']);
Route::post('levels', [LevelController::class, 'store']);
Route::get('levels/{level}', [LevelController::class, 'show']);
Route::put('levels/{level}', [LevelController::class, 'update']);
Route::delete('levels/{level}', [LevelController::class, 'destroy']);

Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::put('users/{user}', [UserController::class, 'update']);
Route::delete('users/{user}', [UserController::class, 'destroy']);

Route::get('categories', [KategoriController::class, 'index']);
Route::post('categories', [KategoriController::class, 'store']);
Route::get('categories/{kategori}', [KategoriController::class, 'show']);
Route::put('categories/{kategori}', [KategoriController::class, 'update']);
Route::delete('categories/{kategori}', [KategoriController::class, 'destroy']);

Route::get('products', [BarangController::class, 'index']);
Route::post('products', [BarangController::class, 'store']);
Route::get('products/{barang}', [BarangController::class, 'show']);
Route::put('products/{barang}', [BarangController::class, 'update']);
Route::delete('products/{barang}', [BarangController::class, 'destroy']);
