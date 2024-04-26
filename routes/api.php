<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonController;
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
Route::post('logIn', [AuthController::class, 'logIn']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('logOut', [AuthController::class, 'logOut']);

    Route::prefix('v1/user')->group(function () {
        Route::get('/', [PersonController::class, 'getAllPerson']);
        Route::post('/create', [PersonController::class, 'create']);
        Route::get('/persons/{user}', [PersonController::class, 'getPersonUser']);
        Route::put('/update/{person}', [PersonController::class, 'update']);
        Route::patch('/disable/{id}', [PersonController::class, 'disable']);
    });
});
