<?php
namespace App\Modules\TesMenu;

use App\Modules\TesMenu\Controllers\TesMenuController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tes-menu')->group(function() {
    // PLACE SUB MENU OF MODULE BELOW

    Route::get('/', [TesMenuController::class, 'index'])->middleware('authorize:read-tes_menu');
    Route::get('/datatable', [TesMenuController::class, 'datatable'])->middleware('authorize:read-tes_menu');
    Route::get('/create', [TesMenuController::class, 'create'])->middleware('authorize:create-tes_menu');
    Route::post('/', [TesMenuController::class, 'store'])->middleware('authorize:create-tes_menu');
    Route::get('/{tes_menu_id}', [TesMenuController::class, 'show'])->middleware('authorize:read-tes_menu');
    Route::get('/{tes_menu_id}/edit', [TesMenuController::class, 'edit'])->middleware('authorize:update-tes_menu');
    Route::put('/{tes_menu_id}', [TesMenuController::class, 'update'])->middleware('authorize:update-tes_menu');
    Route::delete('/{tes_menu_id}', [TesMenuController::class, 'destroy'])->middleware('authorize:delete-tes_menu');
});