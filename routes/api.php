<?php

use App\Http\Controllers\Api\DepartmentApiController;
use App\Http\Controllers\Api\PositionApiController;
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
    Route::post('/addComment','addComment');
});

Route::group([
    'prefix' => 'cabinet',
], function () {
    Route::get('/downloadPersonalReport', [ExcelApiController::class, 'getPersonalReport']);
    Route::get('/downloadTotalReport',    [ExcelApiController::class, 'getTotalReport']);
    Route::get('/downloadFullReport',     [ExcelApiController::class, 'getFullReport']);
    Route::post('/changePassword',        [UserApiController::class, 'changePassword']);
    Route::post('/userInfoEdit',          [UserApiController::class, 'userInfoEdit']);
});

Route::post('/departments', DepartmentApiController::class);
Route::post('/positions',PositionApiController::class);


