<?php

namespace App\Modules\Jabatan;

use App\Modules\Jabatan\Controllers\JabatanController;
use App\Modules\Jabatan\Controllers\RekapJabatanController;
use Illuminate\Support\Facades\Route;

Route::prefix('/jabatan')->group(function () {
    // PLACE SUB MENU OF MODULE BELOW
    Route::prefix('/rekap-jabatan')->group(function () {
        Route::get('/', [RekapJabatanController::class, 'index']);
    });

    Route::get('/', [JabatanController::class, 'index'])->middleware('authorize:read-jabatan');
    Route::get('/datatable', [JabatanController::class, 'datatable'])->middleware('authorize:read-jabatan');
    Route::get('/create', [JabatanController::class, 'create'])->middleware('authorize:create-jabatan');
    Route::post('/', [JabatanController::class, 'store'])->middleware('authorize:create-jabatan');
    Route::get('/{jabatan_id}', [JabatanController::class, 'show'])->middleware('authorize:read-jabatan');
    Route::get('/{jabatan_id}/edit', [JabatanController::class, 'edit'])->middleware('authorize:update-jabatan');
    Route::put('/{jabatan_id}', [JabatanController::class, 'update'])->middleware('authorize:update-jabatan');
    Route::delete('/{jabatan_id}', [JabatanController::class, 'destroy'])->middleware('authorize:delete-jabatan');
});
