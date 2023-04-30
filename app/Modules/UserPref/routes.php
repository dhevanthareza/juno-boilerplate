<?php
namespace App\Modules\UserPref;

use App\Modules\UserPref\Controllers\UserPrefController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user-pref')->group(function() {
    // PLACE SUB MENU OF MODULE BELOW

    Route::get('/', [UserPrefController::class, 'index'])->middleware('authorize:read-user_pref_menu');
    Route::get('/datatable', [UserPrefController::class, 'datatable'])->middleware('authorize:read-user_pref_menu');
    Route::get('/create', [UserPrefController::class, 'create'])->middleware('authorize:create-user_pref_menu');
    Route::post('/', [UserPrefController::class, 'store'])->middleware('authorize:create-user_pref_menu');
    Route::get('/{user_pref_id}', [UserPrefController::class, 'show'])->middleware('authorize:read-user_pref_menu');
    Route::get('/{user_pref_id}/edit', [UserPrefController::class, 'edit'])->middleware('authorize:update-user_pref_menu');
    Route::put('/{user_pref_id}', [UserPrefController::class, 'update'])->middleware('authorize:update-user_pref_menu');
    Route::delete('/{user_pref_id}', [UserPrefController::class, 'destroy'])->middleware('authorize:delete-user_pref_menu');
});