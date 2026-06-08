<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Act;
use App\Models\Quiz;
use App\Models\UserQuizProgress;
use App\Services\QuizService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    /**
     * Show lesson untuk USER (dengan check unlock).
     */
    public function userShow(Lesson $lesson)
    {
        $user = auth()->user();
        $userId = $user->id;

        $lesson->loadMissing(['act.chapter', 'act.quiz']);
        $act = $lesson->act;

        abort_unless($act, 404);

        // Check apakah user bisa akses lesson ini
        if (!$this->quizService->isActUnlocked($userId, $act)) {
            abort(403, 'Anda belum bisa mengakses pelajaran ini!');
        }

        $nextLesson = Lesson::where('act_id', $act->id)
            ->where('id', '>', $lesson->id)
            ->orderBy('id')
            ->first();

        $quiz = $nextLesson ? null : $act->quiz()->firstOrFail();

        return view('user.lesson-show', [
            'user' => $user,
            'lesson' => $lesson,
            'act' => $act,
            'chapter' => $act->chapter,
            'summary' => $this->buildUserSummary($userId),
            'userLevel' => $this->resolveUserLevel((int) $user->total_score),
            'continueUrl' => $nextLesson
                ? route('user.lessons.show', $nextLesson)
                : route('user.quizzes.show', $quiz),
        ]);
    }

    private function buildUserSummary(int $userId): array
    {
        $quizProgress = UserQuizProgress::where('user_id', $userId)->get();
        $passedQuizIds = $quizProgress->where('passed', true)->pluck('quiz_id');
        $completedActIds = Quiz::whereIn('id', $passedQuizIds)->pluck('act_id');

        $totalQuizzes = Quiz::count();
        $completedQuizzes = $quizProgress->count();
        $passedQuizzes = $quizProgress->where('passed', true)->count();
        $totalLessons = Lesson::count();
        $completedLessons = Lesson::whereIn('act_id', $completedActIds)->count();

        return [
            'total_quizzes' => $totalQuizzes,
            'completed_quizzes' => $completedQuizzes,
            'passed_quizzes' => $passedQuizzes,
            'total_lessons' => $totalLessons,
            'completed_lessons' => $completedLessons,
            'progress_percentage' => $totalQuizzes > 0 ? round(($passedQuizzes / $totalQuizzes) * 100) : 0,
        ];
    }

    private function resolveUserLevel(int $totalScore): int
    {
        return max(1, intdiv($totalScore, 500) + 1);
    }

    /**
     * Display a listing of lessons. (ADMIN)
     */
    public function index()
    {
        // Ambil semua lessons dengan eager loading act dan chapter-nya, urutkan by act_id dan id
        $lessons = Lesson::with(['act', 'act.chapter'])
            ->orderBy('act_id')
            ->orderBy('id')
            ->get();

        // Kelompokkan lessons berdasarkan chapter dan act
        $groupedLessons = $lessons->groupBy(function ($lesson) {
            return $lesson->act->chapter_id;
        })->map(function ($lessonsByChapter) {
            return $lessonsByChapter->groupBy('act_id');
        });

        return view('admin.lessons.index', compact('groupedLessons', 'lessons'));
    }

    /**
     * Show the form for creating a new lesson.
     */
    public function create()
    {
        $acts = Act::orderBy('order_number')->get();
        return view('admin.lessons.create', compact('acts'));
    }

    /**
     * Store a newly created lesson in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'act_id' => 'required|exists:acts,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Simpan ke database
        Lesson::create($validated);

        return redirect()->route('admin.lessons.index')
            ->with('success', 'Lesson berhasil ditambahkan!');
    }

    /**
     * Display the specified lesson.
     */
    public function show(Lesson $lesson)
    {
        // Eager load act dan chapter
        $lesson->load(['act', 'act.chapter']);
        return view('admin.lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified lesson.
     */
    public function edit(Lesson $lesson)
    {
        $acts = Act::orderBy('order_number')->get();
        return view('admin.lessons.edit', compact('lesson', 'acts'));
    }

    /**
     * Update the specified lesson in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        // Validasi
        $validated = $request->validate([
            'act_id' => 'required|exists:acts,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Update data
        $lesson->update($validated);

        return redirect()->route('admin.lessons.index')
            ->with('success', 'Lesson berhasil diperbarui!');
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('admin.lessons.index')
            ->with('success', 'Lesson berhasil dihapus!');
    }
}
