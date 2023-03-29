<?php

namespace App\Modules\Employee;

use App\Modules\Employee\Controller\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/datatable', [EmployeeController::class, 'datatable']);
    Route::get('/create', [EmployeeController::class, 'create']);
    Route::post('/', [EmployeeController::class, 'store']);
    Route::get('/{employee_id}', [EmployeeController::class, 'show']);
    Route::get('/{employee_id}/ktp-photo', [EmployeeController::class, 'showKtpPhoto']);
    Route::get('/{employee_id}/edit', [EmployeeController::class, 'edit']);
    Route::put('/{employee_id}', [EmployeeController::class, 'update']);
    Route::delete('/{employee_id}', [EmployeeController::class, 'destroy']);
});
