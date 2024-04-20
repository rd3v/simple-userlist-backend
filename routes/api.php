<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [AuthController::class, 'index']);
Route::post('/users', [AuthController::Class, 'store']);

Route::get('/users/{id}', [AuthController::class, 'show']);
Route::delete('/users/{id}', [AuthController::class, 'destroy']);
Route::put('/users/{id}', [AuthController::class, 'update']);
Route::post('/users/photo/{id}', [UserController::class, 'upload']);