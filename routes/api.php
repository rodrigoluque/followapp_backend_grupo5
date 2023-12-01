<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicationTypeController;
use App\Http\Controllers\PosologiesController;
use App\Http\Controllers\DiagnosticsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistorialController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/register', [AuthController::class, 'create']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('auth/logout', [AuthController::class, 'logout']);
    Route::resource('medication_types',MedicationTypeController::class);
    Route::resource('posologies',PosologiesController::class);
    Route::resource('diagnostics',DiagnosticsController::class);
    Route::resource('users',UserController::class);
    Route::resource('historials',HistorialController::class);
    Route::get('users/{userId}/historials', [UserController::class, 'getUserHistorials']);
});



