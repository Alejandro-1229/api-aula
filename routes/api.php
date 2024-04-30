<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
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
        Route::post('/create', [PersonController::class, 'create']);
        Route::put('/update/{person}', [PersonController::class, 'update']);
        Route::patch('/status/{user}', [PersonController::class, 'changeStatus']);
    });

    Route::prefix('v1/getUsers')->group(function(){
        Route::get('/user/{user}', [UserController::class, 'getSpecificUser']);
        Route::get('/docentes',[UserController::class,'getDocentes']);
        Route::get('/estudiantes',[UserController::class,'getEstudiantes']);
        Route::get('/auxiliares',[UserController::class,'getAuxiliares']);
    });
});
