<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/',[DashboardController::class, 'dashboard']);
Route::get('/GET_DEPT_LIST',[DashboardController::class, 'GetDepartmentList']);
Route::post('/InsertDepartment',[DashboardController::class, 'InsertDepartment']);
?>