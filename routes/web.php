<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// ========== ROUTES AUTHENTICATION ==========
// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== ROUTES USER (MEMERLUKAN LOGIN) ==========
Route::middleware('auth')->group(function () {
    // Dashboard User
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User Management (Public)
    Route::resource('users', UserController::class);
    Route::patch('users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

// ========== ROUTES ADMIN (MEMERLUKAN LOGIN + ROLE ADMIN) ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin Users
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    Route::patch('users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');

    // Admin Chapters
    Route::get('/chapters', function () {
        return view('admin.chapters.index');
    })->name('chapters.index');

    // Admin Acts
    Route::get('/acts', function () {
        return view('admin.acts.index');
    })->name('acts.index');

    // Admin Lessons
    Route::get('/lessons', function () {
        return view('admin.lessons.index');
    })->name('lessons.index');
});
