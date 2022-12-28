<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::post('/character', [CharacterController::class, 'store'])->middleware('auth:sanctum');
