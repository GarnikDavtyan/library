<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\StaffController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('staff')->group(function () {
        Route::apiResource('books', BookController::class)->only([
            'store', 'update', 'destroy'
        ]);
        
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('staff', StaffController::class);
    });

    Route::post('books/{book}/comment', [BookController::class, 'comment'])->middleware('visitor');

    Route::apiResource('books', BookController::class)->only([
        'index', 'show'
    ]);
});