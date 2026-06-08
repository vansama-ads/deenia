# 🚀 QUICK ACTION ITEMS - DEENIA PROJECT

## CRITICAL ISSUES TO FIX IMMEDIATELY

### ⚠️ BLOCKING ISSUE #1: No User Learning Interface

**Problem:** User tidak bisa melihat chapter, act, lessons, atau quiz. User stuck di dashboard.

**Solution - QUICK FIX (Choose ONE):**

#### Option A: Minimal Blade Views (1 hari work)
```
1. Create routes/learning.php (NEW)

   Route::middleware('auth')->prefix('learn')->group(function () {
       Route::get('/chapters', [UserLearningController::class, 'chapters'])->name('learn.chapters');
       Route::get('/chapters/{chapter}', [UserLearningController::class, 'chapter'])->name('learn.chapter');
       Route::get('/acts/{act}', [UserLearningController::class, 'act'])->name('learn.act');
       Route::get('/lessons/{lesson}', [UserLearningController::class, 'lesson'])->name('learn.lesson');
       Route::get('/quizzes/{quiz}', [UserLearningController::class, 'quiz_form'])->name('learn.quiz');
       Route::post('/quizzes/{quiz}', [UserLearningController::class, 'quiz_submit'])->name('learn.quiz.submit');
   });

2. Create Controller: app/Http/Controllers/User/LearningController.php

   public function chapters()
   {
       $chapters = Chapter::with('acts')->orderBy('order_number')->get();
       return view('learn.chapters.index', compact('chapters'));
   }

   public function chapter(Chapter $chapter)
   {
       $chapter->load(['acts' => function($q) { $q->orderBy('order_number'); }]);
       return view('learn.chapters.show', compact('chapter'));
   }

   public function act(Act $act)
   {
       $act->load(['lessons', 'quiz']);
       return view('learn.acts.show', compact('act'));
   }

   public function lesson(Lesson $lesson)
   {
       return view('learn.lessons.show', compact('lesson'));
   }

   public function quiz_form(Quiz $quiz)
   {
       $quiz->load('pairs');
       return view('learn.quizzes.take', compact('quiz'));
   }

   public function quiz_submit(Request $request, Quiz $quiz)
   {
       $answers = $request->validate([
           'answers' => 'required|array',
           'answers.*' => 'required',
       ]);

       $service = new QuizService();
       $progress = $service->submitQuiz(auth()->id(), $quiz->id, $answers['answers']);

       return redirect()->route('learn.quiz.result', $quiz->id)
           ->with('success', 'Quiz submitted!')
           ->with('progress', $progress);
   }

3. Create Views:
   - resources/views/learn/chapters/index.blade.php
   - resources/views/learn/chapters/show.blade.php
   - resources/views/learn/acts/show.blade.php
   - resources/views/learn/lessons/show.blade.php
   - resources/views/learn/quizzes/take.blade.php
   - resources/views/learn/quizzes/result.blade.php

TIME: ~1 day
```

---

### ⚠️ BLOCKING ISSUE #2: API Has No Authentication

**Problem:** Siapa saja bisa DELETE /api/users. API tidak aman. Frontend tidak bisa login via API.

**Solution - QUICK FIX (1-2 hari work):**

```
1. Install Sanctum (if not installed)
   composer require laravel/sanctum
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate

2. Update config/cors.php
   'paths' => ['api/*', 'sanctum/csrf-cookie'],

3. Update routes/api.php
   // Public routes
   Route::post('/auth/register', [AuthApiController::class, 'register']);
   Route::post('/auth/login', [AuthApiController::class, 'login']);

   // Protected routes
   Route::middleware('auth:sanctum')->group(function () {
       Route::resource('chapters', ChapterApiController::class);
       Route::resource('acts', ActApiController::class);
       // ... etc
   });

4. Create app/Http/Controllers/Api/AuthApiController.php
   public function register(Request $request)
   {
       $validated = $request->validate([
           'nickname' => 'required|unique:users',
           'email' => 'required|email|unique:users',
           'password' => 'required|min:6',
       ]);

       $user = User::create([
           'nickname' => $validated['nickname'],
           'email' => $validated['email'],
           'password' => Hash::make($validated['password']),
           'role' => 'user',
           'avatar' => 'avatars/default.jpg',
       ]);

       return response()->json([
           'user' => $user,
           'token' => $user->createToken('api-token')->plainTextToken,
       ], 201);
   }

   public function login(Request $request)
   {
       $credentials = $request->validate([
           'email' => 'required|email',
           'password' => 'required',
       ]);

       if (!Auth::attempt($credentials)) {
           return response()->json(['error' => 'Unauthorized'], 401);
       }

       $user = User::find(auth()->id());
       return response()->json([
           'user' => $user,
           'token' => $user->createToken('api-token')->plainTextToken,
       ]);
   }

TIME: ~1 day
```

---

### ⚠️ BLOCKING ISSUE #3: Level Unlock Not Enforced

**Problem:** User bisa access lesson dari act belum selesai. Tidak ada validasi prerequisite.

**Solution - QUICK FIX (1 day work):**

```
1. Create Middleware: app/Http/Middleware/CheckActUnlock.php

   public function handle(Request $request, Closure $next)
   {
       $lesson = $request->route('lesson');
       $act = $lesson->act;

       // Get previous act
       $previousAct = Act::where('chapter_id', $act->chapter_id)
           ->where('order_number', '<', $act->order_number)
           ->orderByDesc('order_number')
           ->first();

       // If has previous act, check if user passed its quiz
       if ($previousAct) {
           $quiz = $previousAct->quiz;
           if ($quiz) {
               $progress = UserQuizProgress::where('user_id', auth()->id())
                   ->where('quiz_id', $quiz->id)
                   ->where('passed', true)
                   ->first();

               if (!$progress) {
                   return redirect()->route('learn.act', $previousAct->id)
                       ->with('error', 'Selesaikan materi sebelumnya terlebih dahulu');
               }
           }
       }

       return $next($request);
   }

2. Register in app/Http/Kernel.php
   'checkActUnlock' => \App\Http\Middleware\CheckActUnlock::class,

3. Use in routes/learning.php
   Route::get('/lessons/{lesson}', ...)
       ->middleware('checkActUnlock');

TIME: ~1 day
```

---

## ISSUES TO FIX THIS WEEK

### Issue: API Has No Proper Response Handler

**Current Problem:**
```php
// ApiController methods call successResponse() dan errorResponse()
// tapi methods tidak didefinisikan di base Controller
// Result: Exception saat dipanggil
```

**Fix:**
```php
// app/Http/Controllers/Controller.php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function successResponse($message = 'Success', $data = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse($message = 'Error', $code = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
```

TIME: ~15 min

---

### Issue: Redundant Code in Quiz Model

**Current:**
```php
public function pairs()
{
    return $this->hasMany(QuizPair::class);
}

public function quizPairs()
{
    return $this->hasMany(QuizPair::class);  // DUPLICATE!
}
```

**Fix:** Remove one method (keep `pairs()`)

```php
// app/Models/Quiz.php
public function pairs()
{
    return $this->hasMany(QuizPair::class);
}
```

TIME: ~5 min

---

## MISSING API ENDPOINTS TO ADD

### 1. POST /api/quizzes/{id}/submit (CRITICAL)

```php
// routes/api.php
Route::post('/quizzes/{quiz}/submit', [QuizApiController::class, 'submit']);

// app/Http/Controllers/Api/QuizApiController.php
public function submit(Request $request, Quiz $quiz)
{
    $validated = $request->validate([
        'answers' => 'required|array',
        'answers.*.pair_id' => 'required|exists:quiz_pairs,id',
        'answers.*.answer' => 'required|string',
    ]);

    $answers = collect($validated['answers'])
        ->mapWithKeys(fn($item) => [$item['pair_id'] => $item['answer']])
        ->toArray();

    try {
        $service = new QuizService();
        $progress = $service->submitQuiz(auth()->id(), $quiz->id, $answers);

        return $this->successResponse('Quiz submitted', [
            'score' => $progress->score,
            'passed' => $progress->passed,
            'message' => $progress->passed 
                ? 'Selamat! Anda lulus dengan score ' . $progress->score
                : 'Coba lagi. Score Anda ' . $progress->score,
        ]);
    } catch (\Exception $e) {
        return $this->errorResponse('Failed to submit quiz', 500);
    }
}
```

---

### 2. GET /api/user/progress (CRITICAL)

```php
// routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/progress', [UserApiController::class, 'userProgress']);
    Route::get('/user/unlocked-acts', [UserApiController::class, 'unlockedActs']);
});

// app/Http/Controllers/Api/UserApiController.php
public function userProgress()
{
    $progresses = UserQuizProgress::where('user_id', auth()->id())
        ->with(['quiz:id,title', 'quiz.act'])
        ->orderByDesc('completed_at')
        ->get();

    return $this->successResponse('User progress', $progresses);
}

public function unlockedActs()
{
    $completedQuizzes = UserQuizProgress::where('user_id', auth()->id())
        ->where('passed', true)
        ->pluck('quiz_id')
        ->toArray();

    $completedActs = Quiz::whereIn('id', $completedQuizzes)
        ->pluck('act_id')
        ->toArray();

    return $this->successResponse('Unlocked acts', [
        'completed_acts' => $completedActs,
    ]);
}
```

---

## CODE QUALITY ISSUES TO FIX

### 1. Add Database Indices

```php
// Create new migration:
// php artisan make:migration add_indices_to_tables

Schema::table('chapters', function (Blueprint $table) {
    $table->index('order_number');
});

Schema::table('acts', function (Blueprint $table) {
    $table->index(['chapter_id', 'order_number']);
});

Schema::table('lessons', function (Blueprint $table) {
    $table->index('act_id');
});

Schema::table('quizzes', function (Blueprint $table) {
    $table->index('act_id');
});

Schema::table('user_quiz_progress', function (Blueprint $table) {
    $table->index('user_id');
    $table->index('quiz_id');
});
```

---

### 2. Fix N+1 Query in ActController

**Current (BAD):**
```php
public function index()
{
    $chapters = Chapter::with(['acts'])->orderBy('order_number')->get();
    // If acts have lessons/quiz, NOT eager-loaded → N+1
}
```

**Fixed (GOOD):**
```php
public function index()
{
    $chapters = Chapter::with(['acts' => function($query) {
        $query->with(['lessons', 'quiz'])->orderBy('order_number');
    }])->orderBy('order_number')->get();
}
```

---

### 3. Add Pagination to API GET Endpoints

**Current (BAD):**
```php
public function index()
{
    $users = User::all();  // ALL USERS! Will crash with 10K users
    return response()->json($users);
}
```

**Fixed (GOOD):**
```php
public function index(Request $request)
{
    $users = User::paginate($request->per_page ?? 15);
    return response()->json($users);
}
```

---

## SIMPLE TESTING CHECKLIST

Before presentation, verify:

```
AUTHENTICATION
□ GET /register → shows form
□ POST /register → creates user, auto-login
□ GET /login → shows form
□ POST /login → login success, redirect admin or user dashboard
□ POST /logout → logout, redirect to welcome

ADMIN PANEL
□ GET /admin/dashboard → shows stats
□ Admin CRUD Chapters - all 4 operations work
□ Admin CRUD Acts - all 4 operations work
□ Admin CRUD Lessons - all 4 operations work
□ Admin CRUD Quizzes - all 4 operations work
□ Admin CRUD Quiz Pairs - all 4 operations work
□ Admin CRUD Users - all 4 operations work
□ Admin view Progress - can see all user progress

USER LEARNING (NEW - MUST ADD)
□ GET /learn/chapters → shows all chapters
□ GET /learn/chapters/{id} → shows chapter + acts
□ GET /learn/acts/{id} → shows act + lessons
□ GET /learn/lessons/{id} → shows lesson content
□ GET /learn/quizzes/{id} → shows quiz form
□ POST /learn/quizzes/{id} → submits quiz, calculate score
□ GET /my-progress → shows user progress

DATABASE
□ User tabel punya data
□ Chapter tabel punya data
□ Act tabel punya data
□ Lesson tabel punya data
□ Quiz tabel punya data
□ QuizPair tabel punya data

PROGRESS & SCORING
□ After user submit quiz → score calculated
□ After user submit quiz → user.total_score updated
□ After user submit quiz → progress saved
□ Score >= 70 → passed = true
□ Score < 70 → passed = false

API (if using for frontend)
□ GET /api/chapters → returns all chapters
□ GET /api/chapters/{id} → returns chapter with acts
□ GET /api/acts/{id} → returns act with lessons
□ GET /api/quizzes/{id} → returns quiz with pairs
□ POST /api/quizzes/{id}/submit → submits quiz
□ GET /api/user/progress → returns user progress
□ POST /api/auth/login → returns token
```

---

## FILE CHECKLIST - WHAT EXISTS vs WHAT'S MISSING

### ✅ EXISTS
```
✅ app/Http/Controllers/AuthController.php
✅ app/Http/Controllers/ChapterController.php
✅ app/Http/Controllers/ActController.php
✅ app/Http/Controllers/LessonController.php
✅ app/Http/Controllers/Admin/QuizController.php
✅ app/Http/Controllers/Admin/QuizPairController.php
✅ app/Http/Controllers/User/ProgressController.php
✅ app/Http/Controllers/Admin/UserQuizProgressController.php
✅ app/Services/QuizService.php

✅ app/Models/User.php
✅ app/Models/Chapter.php
✅ app/Models/Act.php
✅ app/Models/Lesson.php
✅ app/Models/Quiz.php
✅ app/Models/QuizPair.php
✅ app/Models/UserQuizProgress.php

✅ database/migrations/* (all)
✅ database/seeders/* (all)

✅ routes/web.php
✅ routes/api.php

✅ resources/views/admin/*
✅ resources/views/auth/*
✅ resources/views/user/my-progress.blade.php
```

### ❌ MISSING - CRITICAL
```
❌ app/Http/Controllers/User/LearningController.php      [or UserLearningController]
❌ app/Http/Controllers/Api/AuthApiController.php

❌ app/Http/Middleware/CheckActUnlock.php

❌ resources/views/learn/chapters/index.blade.php
❌ resources/views/learn/chapters/show.blade.php
❌ resources/views/learn/acts/show.blade.php
❌ resources/views/learn/lessons/show.blade.php
❌ resources/views/learn/quizzes/take.blade.php
❌ resources/views/learn/quizzes/result.blade.php
```

---

## TIME ESTIMATE

| Task | Time | Priority |
|------|------|----------|
| Create LearningController | 2-3 hours | CRITICAL |
| Create learning views | 3-4 hours | CRITICAL |
| Add routes for learning | 30 min | CRITICAL |
| Fix API auth (Sanctum) | 1 hour | CRITICAL |
| Create AuthApiController | 1 hour | CRITICAL |
| Add CheckActUnlock middleware | 1 hour | CRITICAL |
| Fix API response handlers | 15 min | CRITICAL |
| Add missing API endpoints | 2 hours | HIGH |
| Add pagination to API | 1 hour | HIGH |
| Fix N+1 queries | 1 hour | MEDIUM |
| Add database indices | 30 min | MEDIUM |
| Write API docs | 1-2 hours | MEDIUM |
| Testing & debugging | 2-3 hours | CRITICAL |

**TOTAL: 16-22 hours (3-4 working days)**

---

## DEPLOYMENT CHECKLIST

Before going live:

```
□ Database migrated
□ Seeders run (php artisan db:seed)
□ All routes registered (php artisan route:list)
□ No DEBUG mode (APP_DEBUG=false in .env)
□ All views compiled
□ Storage symlink exists (php artisan storage:link)
□ Caches cleared (php artisan cache:clear)
□ All tests pass
```

---

## REFERENCE COMMANDS

```bash
# Create controller
php artisan make:controller User/LearningController

# Create middleware
php artisan make:middleware CheckActUnlock

# Create request class
php artisan make:request LearnRequest

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# List all routes
php artisan route:list

# Clear all caches
php artisan cache:clear

# Generate API docs (if using Swagger)
php artisan l5-swagger:generate
```

---

**LAST UPDATED: 8 Juni 2026**  
**STATUS: READY FOR IMPLEMENTATION**
