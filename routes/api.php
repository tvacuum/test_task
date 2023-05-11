<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\ExcelApiController;
use App\Http\Controllers\Api\CategoryApiController;

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
    Route::post('/register',       'create');
    Route::post('/login',          'login');
    Route::post('/edit_user',      'userInfoEdit');
    Route::get('/logout',          'logout');
    Route::post('/delete_user',    'deleteUser');
    Route::get('/get_user',        'getUser');
    Route::get('/get_all_users',   'getAllUsers');
    Route::get('/get_all_readers', 'getAllReaders');
    Route::get('/get_all_workers', 'getAllWorkers');
});

Route::controller(BookApiController::class)->group(function () {
    Route::post('/create_book',  'create');
    Route::get('/get_book',      'getBook');
    Route::get('/get_all_books', 'getAllBooks');
    Route::post('/update_book',  'update');
    Route::post('/delete_book',  'delete');
});

Route::controller(CategoryApiController::class)->group(function () {
    Route::post('/create_category', 'create');
    Route::get('/get_category',     'getCategory');
    Route::post('/update_category', 'update');
    Route::post('/delete_category', 'delete');
});

Route::controller(ExcelApiController::class)->group(function () {
    Route::get('/download_books', 'downloadBooks');
});
