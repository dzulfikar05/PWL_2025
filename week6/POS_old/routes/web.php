<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;

// Halaman Home
Route::get('/', [HomeController::class, 'index']);

// Halaman Products dengan prefix 'category'
Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [ProductController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductController::class, 'babyKid']);
});

// Halaman User dengan parameter id dan name
Route::get('/user/{id}/name/{name}', [UserController::class, 'show']);

// Halaman Sales
Route::get('/sales', [SalesController::class, 'index']);


Route::get('/level', [LevelController::class, 'index']);

// kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get ('/kategori/create', [KategoriController :: class, 'create' ]);
Route::post('/kategori', [KategoriController :: class, 'store' ]);
Route::get ('/kategori/edit/{id}', [KategoriController :: class, 'edit' ]);
Route::put('/kategori/update/{id}', [KategoriController :: class, 'update' ]);
Route::get('/kategori/destroy/{id}', [KategoriController :: class, 'destroy' ]);

// user
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);


Route::resource('m_user', POSController::class);



