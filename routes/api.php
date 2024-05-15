<?php

use Illuminate\Http\Request;

use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;

use App\Http\Controllers\CityController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\OccurrenceController;


use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/login', [LoginController::class, 'login']);
Route::POST('/registeruser', [RegisterController::class, 'registeruser']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::POST('/logout', [LoginController::class, 'logout']);

    Route::post('/cidade', [CityController::class, 'store']);
    Route::get('/cidade', [CityController::class, 'index']);
    Route::get('/cidade/{id}', [CityController::class,'show']);
    Route::get('/cidade/{id}/edit', [CityController::class,'edit']);
    Route::put('/cidade/{id}/update', [CityController::class,'update']);
    Route::delete('/cidade/{id}/delete', [CityController::class,'delete']);

    Route::post('/trash', [TrashController::class, 'store']);
    Route::get('/trash', [TrashController::class, 'index']);
    Route::get('/trash/{id}', [TrashController::class,'show']);
    Route::get('/trash/{id}/edit', [TrashController::class,'edit']);
    Route::put('/trash/{id}/update', [TrashController::class,'update']);
    Route::delete('/trash/{id}/delete', [TrashController::class,'delete']);

    Route::post('/occurrence/create', [OccurrenceController::class, 'store']);
    Route::get('/occurrence', [OccurrenceController::class, 'index']);
    Route::get('/occurrence/{id}', [OccurrenceController::class,'show']);
    Route::get('/occurrence/{id}/edit', [OccurrenceController::class,'edit']);
    Route::put('/occurrence/{id}/update', [OccurrenceController::class,'update']);
    Route::delete('/occurrence/{id}/delete', [OccurrenceController::class,'delete']);

});
