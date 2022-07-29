<?php

namespace App\Modules\User;

use App\Modules\User\Controller\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/login', [UserController::class, 'loginPage']);
    Route::get('/datatable', [UserController::class, 'datatable']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/{user_id}', [UserController::class, 'show']);
    Route::get('/{user_id}/edit', [UserController::class, 'edit']);
    Route::put('/{user_id}', [UserController::class, 'update']);
    Route::delete('/{user_id}', [UserController::class, 'destroy']);
});
