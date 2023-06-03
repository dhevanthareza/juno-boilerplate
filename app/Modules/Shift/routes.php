<?php

namespace App\Modules\Shift;

use App\Modules\Shift\Controllers\ShiftController;
use App\Modules\Shift\Controllers\RekapShiftController;
use Illuminate\Support\Facades\Route;
// USE MARKER (DONT DELETE THIS LINE)


Route::prefix('/shift')->group(function () {
    // SUB MENU MARKER (DONT DELETE THIS LINE)
    Route::prefix('/rekap-shift')->group(function () {
        Route::get('/', [RekapShiftController::class, 'index']);
    });
    
    Route::get('/', [ShiftController::class, 'index'])->middleware('authorize:read-shift');
    Route::get('/datatable', [ShiftController::class, 'datatable'])->middleware('authorize:read-shift');
    Route::get('/create', [ShiftController::class, 'create'])->middleware('authorize:create-shift');
    Route::post('/', [ShiftController::class, 'store'])->middleware('authorize:create-shift');
    Route::get('/{shift_id}', [ShiftController::class, 'show'])->middleware('authorize:read-shift');
    Route::get('/{shift_id}/edit', [ShiftController::class, 'edit'])->middleware('authorize:update-shift');
    Route::put('/{shift_id}', [ShiftController::class, 'update'])->middleware('authorize:update-shift');
    Route::delete('/{shift_id}', [ShiftController::class, 'destroy'])->middleware('authorize:delete-shift');
});
