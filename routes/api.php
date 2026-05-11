<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;

// ========== API USERS ENDPOINTS ==========
// GET /api/users → ambil semua user
Route::get('/users', [UserApiController::class, 'index']);

// GET /api/users/{id} → detail user
Route::get('/users/{id}', [UserApiController::class, 'show']);

// POST /api/users → tambah user
Route::post('/users', [UserApiController::class, 'store']);

// PUT /api/users/{id} → update user
Route::put('/users/{id}', [UserApiController::class, 'update']);

// DELETE /api/users/{id} → hapus user
Route::delete('/users/{id}', [UserApiController::class, 'destroy']);
