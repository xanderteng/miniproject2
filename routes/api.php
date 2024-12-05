<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarAPIController;
use App\Http\Controllers\AuthAPIController;
use App\Http\Middleware\IsLoginAPI;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get-cars', [CarAPIController::class, 'getCars']);
Route::post('/create-cars', [CarAPIController::class, 'store'])->middleware('auth:sanctum', IsLoginAPI::class);
Route::post('/edit-cars/{car}', [CarAPIController::class, 'update'])->middleware('auth:sanctum', IsLoginAPI::class);
Route::delete('/delete-cars/{car}', [CarAPIController::class, 'destroy'])->middleware('auth:sanctum', IsLoginAPI::class);

Route::post('/register', [AuthAPIController::class, 'register']);
Route::post('/login', [AuthAPIController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthAPIController::class, 'logout']);