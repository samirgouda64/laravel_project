<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/',[IndexController::class, 'index']);
Route::post('/postLogin',[IndexController::class, 'postLogin']);
Route::get('/logout',[IndexController::class, 'logout']);

Route::get('/showForgetPassword',[ForgotPasswordController::class, 'showForgetPassword']);
Route::post('/sendOtp',[ForgotPasswordController::class, 'sendOtp']);
Route::post('/verifyOtp',[ForgotPasswordController::class, 'verifyOtp']);
Route::post('/forgotPassword',[ForgotPasswordController::class, 'forgotPassword']);

Route::group(['middleware' => 'usersession'], function () {
    Route::get('/dashboard',[DashboardController::class, 'dashboard']);
    Route::get('/GET_DEPT_LIST',[DashboardController::class, 'GetDepartmentList']);
    Route::post('/InsertDepartment',[DashboardController::class, 'InsertDepartment']);
    Route::post('/UpdateDepartment',[DashboardController::class, 'UpdateDepartment']);
    Route::post('/DeleteDept',[DashboardController::class, 'DeleteDept']);
});
?>