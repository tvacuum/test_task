<?php

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TimeReportApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register',  [UserApiController::class, 'create']);
Route::post('/login',     [UserApiController::class, 'login']);
Route::post('/logout',    [UserApiController::class, 'logout']);

Route::post('/startDay',  [TimeReportApiController::class, 'startDay']);
Route::post('/pauseDay',  [TimeReportApiController::class, 'pauseDay']);
Route::post('/resumeDay', [TimeReportApiController::class, 'resumeDay']);
Route::post('/endDay',    [TimeReportApiController::class, 'endDay']);

Route::get('/downloadReport', [ExcelApiController::class, 'downloadPersonalReport']);
