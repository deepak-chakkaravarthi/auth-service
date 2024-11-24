<?php

// routes/api.php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::post('register', [UserController::class, 'register']);
Route::put('user/{id}', [UserController::class, 'update'])->middleware('auth:api');
Route::delete('user/{id}', [UserController::class, 'delete'])->middleware('auth:api');
Route::get('user/{id}', [UserController::class, 'getUserDetails'])->middleware('auth:api');


Route::post('assign-role/{userId}', [RoleController::class, 'assignRole'])->middleware('auth:api');
Route::post('remove-role/{userId}', [RoleController::class, 'removeRole'])->middleware('auth:api');

