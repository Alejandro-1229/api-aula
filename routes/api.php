<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonController;
use GuzzleHttp\Promise\Create;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('logIn',[AuthController::class, 'logIn']);


//Route::middleware('auth:sanctum')->group(function () {

Route::post('logOut', [AuthController::class, 'logOut']);

Route::prefix('user')->group(function () {
    Route::get('/', [PersonController::class, 'getAllPerson']);
    Route::post('/create', [PersonController::class, 'create']);
    Route::put('/update/{id}', [PersonController::class, 'update']);
    Route::patch('/disable/{id}', [PersonController::class, 'disable']);
});
//});
