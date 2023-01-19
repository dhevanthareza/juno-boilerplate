<?php
namespace App\Modules\Module;

use App\Modules\Menu\Controller\MenuController;
use Illuminate\Support\Facades\Route;
Route::prefix('/module')->group(function() {
    Route::get('/', [MenuController::class, 'index']);
    Route::get('/create', [MenuController::class, 'create']);
    Route::post('/', [MenuController::class, 'store']);
    Route::get('/{menu_id}', [MenuController::class, 'show']);
    Route::get('/{menu_id}/detail', [MenuController::class, 'detail']);
    Route::get('/{menu_id}/edit', [MenuController::class, 'edit']);
    Route::put('/{menu_id}', [MenuController::class, 'update']);
});