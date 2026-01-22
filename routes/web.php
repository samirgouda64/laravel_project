<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;

Route::get('/',[IndexController::class, 'index']);
Route::post('/postLogin',[IndexController::class, 'postLogin']);
Route::get('/logout',[IndexController::class, 'logout']);

Route::group(['middleware' => 'usersession'], function () {
    Route::get('/dashboard',[DashboardController::class, 'dashboard']);
    Route::get('/GET_DEPT_LIST',[DashboardController::class, 'GetDepartmentList']);
    Route::post('/InsertDepartment',[DashboardController::class, 'InsertDepartment']);
    Route::post('/UpdateDepartment',[DashboardController::class, 'UpdateDepartment']);
    Route::post('/DeleteDept',[DashboardController::class, 'DeleteDept']);
});
?>