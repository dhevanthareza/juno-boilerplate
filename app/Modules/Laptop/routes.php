<?php

namespace App\Modules\Laptop;

use App\Modules\Laptop\Controllers\LaptopController;
use Illuminate\Support\Facades\Route;
use App\Modules\UserPref\Controllers\RekapLaptopController;
use App\Modules\UserPref\Controllers\JadwalLaptopController;
use App\Modules\UserPref\Controllers\StockLaptopController;
use App\Modules\UserPref\Controllers\LaptopHarianController;
// USE MARKER (DONT DELETE THIS LINE)

Route::prefix('/laptop')->group(function () {
    Route::prefix('/rekap-laptop')->group(function () {
        Route::get('/', [RekapLaptopController::class, 'index']);
    });
    Route::prefix('/jadwal-laptop')->group(function () {
        Route::get('/', [JadwalLaptopController::class, 'index']);
    });
    Route::prefix('/stock-laptop')->group(function () {
        Route::get('/', [StockLaptopController::class, 'index']);
    });
    Route::prefix('/laptop-harian')->group(function() {
        Route::get('/', [LaptopHarianController::class, 'index']);
    });
    // SUB MENU MARKER (DONT DELETE THIS LINE)

    Route::get('/', [LaptopController::class, 'index'])->middleware('authorize:read-laptop');
    Route::get('/datatable', [LaptopController::class, 'datatable'])->middleware('authorize:read-laptop');
    Route::get('/create', [LaptopController::class, 'create'])->middleware('authorize:create-laptop');
    Route::post('/', [LaptopController::class, 'store'])->middleware('authorize:create-laptop');
    Route::get('/{laptop_id}', [LaptopController::class, 'show'])->middleware('authorize:read-laptop');
    Route::get('/{laptop_id}/edit', [LaptopController::class, 'edit'])->middleware('authorize:update-laptop');
    Route::put('/{laptop_id}', [LaptopController::class, 'update'])->middleware('authorize:update-laptop');
    Route::delete('/{laptop_id}', [LaptopController::class, 'destroy'])->middleware('authorize:delete-laptop');
});
