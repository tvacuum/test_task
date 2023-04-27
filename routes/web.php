<?php

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TimeReportApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',     [UserApiController::class, 'login']);
Route::get('/logout',    [UserApiController::class, 'logout']);
Route::get('/startDay',  [TimeReportApiController::class, 'startDay']);
Route::get('/pauseDay',  [TimeReportApiController::class, 'pauseDay']);
Route::get('/resumeDay', [TimeReportApiController::class, 'resumeDay']);
Route::get('/endDay',    [TimeReportApiController::class, 'endDay']);
