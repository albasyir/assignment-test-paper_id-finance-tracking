<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);

    Route::prefix('/finance')->group(function () {
        Route::apiResource("/account", AccountController::class);
        Route::apiResource("/transaction", TransactionController::class);

        Route::get('/report/transaction', [ReportController::class, 'transaction']);
    });
});
