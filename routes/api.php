<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ActApiController;
use App\Http\Controllers\Api\ChapterApiController;
use App\Http\Controllers\Api\LessonApiController;
use App\Http\Controllers\Api\QuizApiController;
use App\Http\Controllers\Api\QuizPairApiController;
use App\Http\Controllers\Api\UserQuizProgressApiController;

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

// ========== API CHAPTERS ENDPOINTS ==========
Route::get('/chapters', [ChapterApiController::class, 'index']);
Route::get('/chapters/{id}', [ChapterApiController::class, 'show']);
Route::post('/chapters', [ChapterApiController::class, 'store']);
Route::put('/chapters/{id}', [ChapterApiController::class, 'update']);
Route::delete('/chapters/{id}', [ChapterApiController::class, 'destroy']);

// ========== API ACTS ENDPOINTS ==========
Route::get('/acts', [ActApiController::class, 'index']);
Route::get('/acts/{id}', [ActApiController::class, 'show']);
Route::post('/acts', [ActApiController::class, 'store']);
Route::put('/acts/{id}', [ActApiController::class, 'update']);
Route::delete('/acts/{id}', [ActApiController::class, 'destroy']);

// ========== API LESSONS ENDPOINTS ==========
Route::get('/lessons', [LessonApiController::class, 'index']);
Route::get('/lessons/{id}', [LessonApiController::class, 'show']);
Route::post('/lessons', [LessonApiController::class, 'store']);
Route::put('/lessons/{id}', [LessonApiController::class, 'update']);
Route::delete('/lessons/{id}', [LessonApiController::class, 'destroy']);

// ========== API QUIZZES ENDPOINTS ==========
Route::get('/quizzes', [QuizApiController::class, 'index']);
Route::get('/quizzes/{id}', [QuizApiController::class, 'show']);
Route::post('/quizzes', [QuizApiController::class, 'store']);
Route::put('/quizzes/{id}', [QuizApiController::class, 'update']);
Route::delete('/quizzes/{id}', [QuizApiController::class, 'destroy']);

// ========== API QUIZ PAIRS ENDPOINTS ==========
Route::get('/quiz-pairs', [QuizPairApiController::class, 'index']);
Route::get('/quiz-pairs/{id}', [QuizPairApiController::class, 'show']);
Route::post('/quiz-pairs', [QuizPairApiController::class, 'store']);
Route::put('/quiz-pairs/{id}', [QuizPairApiController::class, 'update']);
Route::delete('/quiz-pairs/{id}', [QuizPairApiController::class, 'destroy']);

// ========== API USER QUIZ PROGRESS ENDPOINTS ==========
Route::get('/user-progress', [UserQuizProgressApiController::class, 'index']);
Route::get('/user-progress/{id}', [UserQuizProgressApiController::class, 'show']);
Route::post('/user-progress', [UserQuizProgressApiController::class, 'store']);
Route::put('/user-progress/{id}', [UserQuizProgressApiController::class, 'update']);
Route::delete('/user-progress/{id}', [UserQuizProgressApiController::class, 'destroy']);
