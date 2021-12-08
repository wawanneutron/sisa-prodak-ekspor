<?php

use App\Http\Controllers\StatistikController;
use App\Http\Controllers\AprovalController;
use App\Http\Controllers\OverProductController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



/* admin gudang */

Route::prefix('admin-gudang')
    ->middleware(['auth', 'admin.gudang'])
    ->group(function () {
        Route::get('/', [StatistikController::class, 'index'])
            ->name('statistik-admin');

        Route::resource('/data-products', ProductController::class, ['as' => 'dashboard']);
        Route::resource('/over-products', OverProductController::class, ['as' => 'dashboard']);

        Route::resource('/pengajuan', AprovalController::class, ['as' => 'dashboard']);

        Route::get('/ajax/products/search', [ProductController::class, 'ajaxSearch']);
        Route::get('/ajax/over-products/search', [OverProductController::class, 'ajaxSearchOver']);
    });

/* supervisor */
Route::prefix('supervisor')
    ->middleware(['auth', 'supervisor'])
    ->group(function () {
        Route::get('/', [StatistikController::class, 'index'])
            ->name('statistik-spv');

        Route::get('/data-products', [ProductController::class, 'supervisor'])
            ->name('products-spv');

        Route::get('/over-products', [OverProductController::class, 'index'])
            ->name('spv-over');

        Route::get('/pengajuan', [AprovalController::class, 'index'])
            ->name('spv-pengajuan');
    });


/* kepala gudang */
Route::prefix('kepala-gudang')
    ->middleware(['auth', 'kepala.gudang'])
    ->group(function () {
        Route::get('/', [StatistikController::class, 'index'])
            ->name('statistik-kepala');

        Route::get('/data-products', [ProductController::class, 'kepalaGudang'])
            ->name('products-kepala');

        Route::get('/over-products', [OverProductController::class, 'index'])
            ->name('kepala-over');

        Route::get('/pengajuan', [AprovalController::class, 'index'])
            ->name('kepala-pengajuan');
    });
