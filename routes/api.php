<?php

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TimeReportApiController;
use App\Http\Controllers\Api\ExcelApiController;
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

Route::controller(UserApiController::class)->group(function () {
    Route::post('/register',  'create');
    Route::post('/login',     'login');
    Route::post('/logout',    'logout');
});


Route::controller(TimeReportApiController::class)->group(function () {
    Route::post('/startDay',  'startDay');
    Route::post('/pauseDay',  'pauseDay');
    Route::post('/resumeDay', 'resumeDay');
    Route::post('/endDay',    'endDay');
    Route::post('/addComment', 'addComment');
});

Route::get('/getPersonalReport', [ExcelApiController::class, 'getPersonalReport']);
