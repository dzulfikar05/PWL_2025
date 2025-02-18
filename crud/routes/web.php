<?php

use App\Http\Controllers\ItemController; // Import ItemController
use App\Http\Controllers\WelcomeController; // Import WelcomeController
use Illuminate\Support\Facades\Route; // Import Route

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

Route::get('/', function () { // Route / untuk mengembalikan view welcome
    return view('welcome');
});

Route::get('/hello', function () { // Reoute /hello untuk mengembalikan string Hello World
    return 'Hello World';
});

Route::get('/hello', [WelcomeController::class, 'hello']); // Route /hello untuk mengarahkan ke method hello di WelcomeController


Route::resource('items', ItemController::class); // Route /items untuk mengelola item yang berisikan create, store, show, edit, update, dan destroy
