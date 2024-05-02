<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\SpecialtyController;
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

    //OPERACIONES CON RESPECTO A LOS USUARIOS (CRUD)
    Route::prefix('v1/user')->group(function () {
        Route::post('/create', [PersonController::class, 'create']);
        Route::put('/update/{person}', [PersonController::class, 'update']);
        Route::patch('/status/{user}', [PersonController::class, 'changeStatus']);
    });

    //TRAER A LOS USUARIOS CON RESPECTO A EL ROL DE USUARIO
    Route::prefix('v1/getUsers')->group(function(){
        Route::get('/user/{person}', [UserController::class, 'getSpecificUser']);
        Route::get('/docentes',[UserController::class,'getDocentes']);
        Route::get('/estudiantes',[UserController::class,'getEstudiantes']);
        Route::get('/auxiliares',[UserController::class,'getAuxiliares']);
    });

    //OPERACIONES DE INTERESES DE LOS ESTUDIANTES
    Route::prefix('v1/interest')->group(function () {
        Route::get('/', [InterestController::class, 'getAllInterest']);
        Route::get('/unique/{interest}', [InterestController::class, 'getInterest']);
        Route::post('/create', [InterestController::class, 'createInterest']);
        Route::put('/update/{interest}', [InterestController::class, 'updateInterest']);
    });

    //OPERACIONES DE ESPECIALIDADES DE LOS DOCENTES
    Route::prefix('v1/specialty')->group(function () {
        Route::get('/', [SpecialtyController ::class, 'getAllSpecialties']);
        Route::get('/unique/{specialty}', [SpecialtyController::class, 'getSpecialty']);
        Route::post('/create', [SpecialtyController::class, 'createSpecialty']);
        Route::put('/update/{specialty}', [SpecialtyController::class, 'updateSpecialty']);
    });
    /*-------------------------------CORREGIR---------------------------*/ 

    Route::prefix('v1/assistant')->group(function () {
        Route::get('/unique/{specialty}', [AssistantController::class, 'getAssistant']);
        Route::post('/create', [AssistantController::class, 'createAssistant']);
        Route::put('/update/{specialty}', [AssistantController::class, 'updateAssistant']);
    });
});
