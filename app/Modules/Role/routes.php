<?php

namespace App\Modules\Role;

use App\Modules\Role\Controller\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/role')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/datatable', [RoleController::class, 'datatable']);
    Route::get('/create', [RoleController::class, 'create']);
    Route::post('/', [RoleController::class, 'store']);
    Route::get('/{menu_id}', [RoleController::class, 'show']);
    Route::get('/{menu_id}/detail', [RoleController::class, 'detail']);
    Route::get('/{menu_id}/edit', [RoleController::class, 'edit']);
    Route::put('/{menu_id}', [RoleController::class, 'update']);
    Route::delete('/{menu_id}', [RoleController::class, 'destroy']);
});
