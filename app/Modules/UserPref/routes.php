<?php
namespace App\Modules\UserPref;

use App\Modules\UserPref\Controllers\UserPrefController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user-pref')->group(function() {
    Route::get('/', [UserPrefController::class, 'index']);
    Route::get('/datatable', [UserPrefController::class, 'datatable']);
    Route::get('/create', [UserPrefController::class, 'create']);
    Route::post('/', [UserPrefController::class, 'store']);
    Route::get('/{user_pref_id}', [UserPrefController::class, 'show']);
    Route::get('/{user_pref_id}/edit', [UserPrefController::class, 'edit']);
    Route::put('/{user_pref_id}', [UserPrefController::class, 'update']);
    Route::delete('/{user_pref_id}', [UserPrefController::class, 'destroy']);
});