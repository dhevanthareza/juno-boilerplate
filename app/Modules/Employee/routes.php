<?php
namespace App\Modules\Employee;

use App\Modules\Employee\Controller\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::resource('employee', EmployeeController::class);