<?php

use App\Http\Controllers\StatistikController;
use App\Http\Controllers\AprovalController;
use App\Http\Controllers\LaporanController;
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

        Route::view('/account-setting', 'pages.dashboard.profile.index')->name('profile-admin');

        /* generate pdf */
        Route::get('/laporan-product', [LaporanController::class, 'laporanProduct'])->name('admin-laporan-product');
        Route::get('/print-product/{id}', [LaporanController::class, 'printProduct'])->name('admin-print-laporan-product');

        Route::get('/laporan-baranglebih', [LaporanController::class, 'laporanBarangLebih'])->name('admin-laporan-barang-lebih');
        Route::get('/print-baranglebih/{id}', [LaporanController::class, 'printBarangLebih'])->name('print-laporan-baranglebih');

        Route::get('/laporan-pengajuan', [LaporanController::class, 'laporanPengajuan'])->name('laporan-pengajuan');
        Route::get('/print-pengajuan/{id}', [LaporanController::class, 'printPengajuan'])->name('print-laporan-pengajuan');

        /* ajax search select2*/
        Route::get('/ajax/products/search', [ProductController::class, 'ajaxSearch']);
        Route::get('/ajax/over-products/search', [OverProductController::class, 'ajaxSearchOver']);
    });

/* supervisor */
Route::prefix('supervisor')
    ->middleware(['auth', 'supervisor'])
    ->group(function () {
        Route::get('/', [StatistikController::class, 'index'])
            ->name('statistik-spv');

        Route::get('/data-products', [ProductController::class, 'index'])
            ->name('products-spv');

        Route::get('/over-products', [OverProductController::class, 'index'])
            ->name('spv-over');

        Route::get('/pengajuan', [AprovalController::class, 'index'])
            ->name('spv-pengajuan');

        Route::put('/pengajuan/{id}', [AprovalController::class, 'update'])
            ->name('spv-pengajuan-update');

        Route::view('/account-setting', 'pages.dashboard.profile.index')->name('profile-spv');

        /* generate pdf */
        Route::get('/laporan-product', [LaporanController::class, 'laporanProduct'])->name('spv-laporan-product');
        Route::get('/print-product/{id}', [LaporanController::class, 'printProduct'])->name('spv-print-laporan-product');

        Route::get('/laporan-baranglebih', [LaporanController::class, 'laporanBarangLebih'])->name('spv-laporan-barang-lebih');
        Route::get('/print-baranglebih/{id}', [LaporanController::class, 'printBarangLebih'])->name('spv-print-laporan-baranglebih');

        Route::get('/laporan-pengajuan', [LaporanController::class, 'laporanPengajuan'])->name('spv-laporan-pengajuan');
        Route::get('/print-pengajuan/{id}', [LaporanController::class, 'printPengajuan'])->name('spv-print-laporan-pengajuan');
    });


/* kepala gudang */
Route::prefix('kepala-gudang')
    ->middleware(['auth', 'kepala.gudang'])
    ->group(function () {
        Route::get('/', [StatistikController::class, 'index'])
            ->name('statistik-kepala');

        Route::get('/data-products', [ProductController::class, 'index'])
            ->name('products-kepala');

        Route::get('/over-products', [OverProductController::class, 'index'])
            ->name('kepala-over');

        Route::get('/pengajuan', [AprovalController::class, 'index'])
            ->name('kepala-pengajuan');

        Route::put('/pengajuan/{id}', [AprovalController::class, 'update'])
            ->name('kepala-pengajuan-update');

        Route::view('/account-setting', 'pages.dashboard.profile.index')->name('profile-kepala');

        /* generate pdf */
        Route::get('/laporan-product', [LaporanController::class, 'laporanProduct'])->name('kepala-laporan-product');
        Route::get('/print-product/{id}', [LaporanController::class, 'printProduct'])->name('kepala-print-laporan-product');

        Route::get('/laporan-baranglebih', [LaporanController::class, 'laporanBarangLebih'])->name('kepala-laporan-barang-lebih');
        Route::get('/print-baranglebih/{id}', [LaporanController::class, 'printBarangLebih'])->name('kepala-print-laporan-baranglebih');

        Route::get('/laporan-pengajuan', [LaporanController::class, 'laporanPengajuan'])->name('kepala-laporan-pengajuan');
        Route::get('/print-pengajuan/{id}', [LaporanController::class, 'printPengajuan'])->name('kepala-print-laporan-pengajuan');
    });
