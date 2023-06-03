<?php
namespace App\Modules\Presensi;

use App\Modules\Presensi\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

Route::prefix('/presensi')->group(function() {
    // PLACE SUB MENU OF MODULE BELOW

    Route::get('/', [PresensiController::class, 'index'])->middleware('authorize:read-presensi');
    Route::get('/datatable', [PresensiController::class, 'datatable'])->middleware('authorize:read-presensi');
    Route::get('/create', [PresensiController::class, 'create'])->middleware('authorize:create-presensi');
    Route::post('/', [PresensiController::class, 'store'])->middleware('authorize:create-presensi');
    Route::get('/{presensi_id}', [PresensiController::class, 'show'])->middleware('authorize:read-presensi');
    Route::get('/{presensi_id}/edit', [PresensiController::class, 'edit'])->middleware('authorize:update-presensi');
    Route::put('/{presensi_id}', [PresensiController::class, 'update'])->middleware('authorize:update-presensi');
    Route::delete('/{presensi_id}', [PresensiController::class, 'destroy'])->middleware('authorize:delete-presensi');
});