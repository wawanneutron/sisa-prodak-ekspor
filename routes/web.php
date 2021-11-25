<?php

use App\Http\Controllers\AdminGudang\DashboardController;
use App\Http\Controllers\AdminGudang\ProductController;
use Illuminate\Support\Facades\Route;

/* admin gudang */

Route::prefix('admin-gudang')
    ->middleware(['auth', 'admin.gudang'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'statistik'])
            ->name('admin-gudang');

        Route::get('/products-admin', [ProductController::class, 'index'])
            ->name('products-admin');
    });

/* supervisor */
Route::prefix('supervisor')
    ->middleware(['auth', 'supervisor'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'statistik'])
            ->name('supervisor');

        Route::get('/products-SPV', [ProductController::class, 'index'])
            ->name('products-spv');
    });


/* kepala gudang */
Route::prefix('kepala-gudang')
    ->middleware(['auth', 'kepala.gudang'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'statistik'])
            ->name('home-dashboard');

        Route::get('/products-kepala-gudang', [ProductController::class, 'index'])
            ->name('products-kepala');
    });
