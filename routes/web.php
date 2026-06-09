<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ActController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\User\LearnController;
use App\Models\Act;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;

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
    // User Learn Dashboard
    Route::get('/learn', [LearnController::class, 'index'])->name('learn');
    Route::get('/dashboard', fn () => redirect()->route('learn'))->name('dashboard');

    // User Learning Routes
    Route::prefix('user')->name('user.')->group(function () {
        // Chapters
        Route::get('/chapters', [ChapterController::class, 'userChapters'])->name('chapters');
        
        // Acts
        Route::get('/acts/{act}', [ActController::class, 'userShow'])->name('acts.show');
        
        // Lessons
        Route::get('/lessons/{lesson}', [LessonController::class, 'userShow'])->name('lessons.show');
        
        // Quizzes
        Route::get('/quizzes/{quiz}', [App\Http\Controllers\Admin\QuizController::class, 'userShow'])->name('quizzes.show');
        Route::post('/quizzes/{quiz}/submit', [App\Http\Controllers\Admin\QuizController::class, 'userSubmit'])->name('quizzes.submit');
    });

    // User My Progress
    Route::get('/my-progress', [App\Http\Controllers\User\ProgressController::class, 'myProgress'])->name('my-progress');

    // User Management (Public)
    Route::resource('users', UserController::class);
    Route::patch('users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

// ========== ROUTES ADMIN (MEMERLUKAN LOGIN + ROLE ADMIN) ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalChapters' => Chapter::count(),
            'totalActs' => Act::count(),
            'totalLessons' => Lesson::count(),
        ]);
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
    Route::resource('chapters', ChapterController::class)->names([
        'index' => 'chapters.index',
        'create' => 'chapters.create',
        'store' => 'chapters.store',
        'edit' => 'chapters.edit',
        'update' => 'chapters.update',
        'destroy' => 'chapters.destroy',
    ]);

    // Admin Acts
    Route::resource('acts', ActController::class)->names([
        'index' => 'acts.index',
        'create' => 'acts.create',
        'store' => 'acts.store',
        'edit' => 'acts.edit',
        'update' => 'acts.update',
        'destroy' => 'acts.destroy',
    ]);

    // Admin Lessons
    Route::resource('lessons', LessonController::class)->names([
        'index' => 'lessons.index',
        'create' => 'lessons.create',
        'store' => 'lessons.store',
        'show' => 'lessons.show',
        'edit' => 'lessons.edit',
        'update' => 'lessons.update',
        'destroy' => 'lessons.destroy',
    ]);

    // Admin Quizzes
    Route::resource('quizzes', App\Http\Controllers\Admin\QuizController::class)->names([
        'index' => 'quizzes.index',
        'create' => 'quizzes.create',
        'store' => 'quizzes.store',
        'edit' => 'quizzes.edit',
        'update' => 'quizzes.update',
        'destroy' => 'quizzes.destroy',
    ]);

    // Admin QuizPairs
    Route::get('quiz-pairs', [App\Http\Controllers\Admin\QuizPairController::class, 'allIndex'])->name('quiz-pairs.index');

    // Admin QuizPairs (nested under quizzes)
    Route::get('quizzes/{quiz}/pairs', [App\Http\Controllers\Admin\QuizPairController::class, 'index'])->name('quizzes.pairs.index');
    Route::get('quizzes/{quiz}/pairs/create', [App\Http\Controllers\Admin\QuizPairController::class, 'create'])->name('quizzes.pairs.create');
    Route::post('quizzes/{quiz}/pairs', [App\Http\Controllers\Admin\QuizPairController::class, 'store'])->name('quizzes.pairs.store');
    Route::get('quizzes/{quiz}/pairs/{pair}/edit', [App\Http\Controllers\Admin\QuizPairController::class, 'edit'])->name('quizzes.pairs.edit');
    Route::put('quizzes/{quiz}/pairs/{pair}', [App\Http\Controllers\Admin\QuizPairController::class, 'update'])->name('quizzes.pairs.update');
    Route::delete('quizzes/{quiz}/pairs/{pair}', [App\Http\Controllers\Admin\QuizPairController::class, 'destroy'])->name('quizzes.pairs.destroy');

    // Admin User Quiz Progress
    Route::resource('progresses', App\Http\Controllers\Admin\UserQuizProgressController::class)->names([
        'index' => 'progresses.index',
        'create' => 'progresses.create',
        'store' => 'progresses.store',
        'show' => 'progresses.show',
        'edit' => 'progresses.edit',
        'update' => 'progresses.update',
        'destroy' => 'progresses.destroy',
    ]);
});
