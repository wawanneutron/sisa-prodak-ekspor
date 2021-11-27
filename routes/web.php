<?php

use App\Http\Controllers\AdminGudang\DashboardController;
use App\Http\Controllers\AdminGudang\OverProductController;
use App\Http\Controllers\AdminGudang\PengajuanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KepalaGudang\PengajuanController as KepalaGudangPengajuanController;
use App\Http\Controllers\Supervisor\PengajuanController as SupervisorPengajuanController;
use App\Models\OverProduct;
use Illuminate\Support\Facades\Route;



/* admin gudang */

Route::prefix('admin-gudang')
    ->middleware(['auth', 'admin.gudang'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'statistik'])
            ->name('statistik-admin');

        Route::resource('/data-products', ProductController::class, ['as' => 'dashboard']);
        Route::resource('/over-products', OverProductController::class, ['as' => 'dashboard']);

        Route::get('/pengajuan', [PengajuanController::class, 'index'])
            ->name('admin-pengajuan');
    });

/* supervisor */
Route::prefix('supervisor')
    ->middleware(['auth', 'supervisor'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'statistik'])
            ->name('statistik-spv');

        Route::get('/data-products', [ProductController::class, 'supervisor'])
            ->name('products-spv');

        Route::get('/pengajuan', [SupervisorPengajuanController::class, 'index'])
            ->name('spv-pengajuan');
    });


/* kepala gudang */
Route::prefix('kepala-gudang')
    ->middleware(['auth', 'kepala.gudang'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'statistik'])
            ->name('statistik-kepala');

        Route::get('/data-products', [ProductController::class, 'kepalaGudang'])
            ->name('products-kepala');

        Route::get('/pengajuan', [KepalaGudangPengajuanController::class, 'index'])
            ->name('kepala-pengajuan');
    });
