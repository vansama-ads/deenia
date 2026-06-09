<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Act;
use App\Models\Lesson;
use App\Models\UserQuizProgress;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    /**
     * Show quiz untuk USER (dengan check unlock).
     */
    public function userShow(Request $request, Quiz $quiz)
    {
        $user = auth()->user();
        $userId = $user->id;

        $quiz->loadMissing(['pairs', 'act.chapter']);
        $act = $quiz->act;

        abort_unless($act, 404);

        // Check apakah user bisa akses quiz ini (via act unlock)
        if (!$this->quizService->isActUnlocked($userId, $act)) {
            $previousAct = $act->previousAct();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Selesaikan Act sebelumnya terlebih dahulu!',
                    'data' => [
                        'required_act' => $previousAct ? $previousAct->name : null,
                    ],
                ], 403);
            }

            abort(403, 'Selesaikan Act sebelumnya terlebih dahulu!');
        }

        $previousProgress = UserQuizProgress::where('user_id', $userId)
            ->where('quiz_id', $quiz->id)
            ->first();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'quiz' => $quiz,
                    'act' => $act,
                    'pairs_count' => $quiz->pairs->count(),
                    'previous_progress' => $previousProgress,
                    'unlocked' => true,
                ],
            ]);
        }

        return view('user.quiz-show', [
            'user' => $user,
            'quiz' => $quiz,
            'act' => $act,
            'chapter' => $act->chapter,
            'pairs' => $quiz->pairs,
            'rightOptions' => $quiz->pairs->pluck('right_text')->shuffle()->values(),
            'previousProgress' => $previousProgress,
            'summary' => $this->buildUserSummary($userId),
            'userLevel' => $this->resolveUserLevel((int) $user->total_score),
        ]);
    }

    /**
     * Submit quiz answers dari USER.
     */
    public function userSubmit(Request $request, Quiz $quiz)
    {
        $userId = auth()->id();
        $quiz->loadMissing(['pairs', 'act']);
        $act = $quiz->act;

        abort_unless($act, 404);

        // Check unlock
        if (!$this->quizService->isActUnlocked($userId, $act)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak!',
                ], 403);
            }

            abort(403, 'Akses ditolak!');
        }

        // Validasi input
        $validated = $request->validate([
            'answers' => ['required', 'array', 'size:' . $quiz->pairs->count()],
            'answers.*' => 'required|string',
        ]);

        $pairIds = $quiz->pairs->pluck('id')->map(fn ($id) => (string) $id);
        $answerIds = collect(array_keys($validated['answers']))->map(fn ($id) => (string) $id);
        $missingPairIds = $pairIds->diff($answerIds);

        if ($missingPairIds->isNotEmpty()) {
            return back()
                ->withErrors(['answers' => 'Semua pasangan harus dipilih sebelum submit.'])
                ->withInput();
        }

        try {
            $correct = $quiz->pairs->filter(function ($pair) use ($validated) {
                return ($validated['answers'][$pair->id] ?? null) === $pair->right_text;
            })->count();
            $total = $quiz->pairs->count();

            // Submit via QuizService
            $progress = $this->quizService->submitQuiz($userId, $quiz->id, $validated['answers']);

            $result = [
                'score' => $progress->score,
                'correct' => $correct,
                'total' => $total,
                'passed' => $progress->passed,
            ];

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Quiz berhasil disubmit!',
                    'data' => [
                        'score' => $progress->score,
                        'correct' => $correct,
                        'total' => $total,
                        'passed' => $progress->passed,
                        'message' => $progress->passed
                            ? 'Selamat! Anda lulus dengan score ' . $progress->score
                            : 'Coba lagi. Score Anda ' . $progress->score,
                        'progress' => $progress,
                    ],
                ]);
            }

            return redirect()
                ->route('user.quizzes.show', $quiz)
                ->with('quiz_result', $result)
                ->with(
                    $progress->passed ? 'success' : 'error',
                    $progress->passed
                        ? 'Quiz selesai. Act berikutnya sudah terbuka.'
                        : 'Quiz selesai. Coba lagi untuk membuka Act berikutnya.'
                );
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Terjadi kesalahan saat submit quiz.')->withInput();
        }
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

    public function index()
    {
        // Get all quizzes grouped by chapter and act
        $quizzes = Quiz::with(['act.chapter', 'pairs'])
            ->whereHas('act')
            ->orderBy('act_id')
            ->get()
            ->groupBy(function ($quiz) {
                return $quiz->act->chapter_id;
            })
            ->map(function ($chapterQuizzes) {
                return $chapterQuizzes->groupBy(function ($quiz) {
                    return $quiz->act_id;
                });
            });
        
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $acts = Act::with('chapter')->orderBy('chapter_id')->orderBy('order_number')->get();
        return view('admin.quizzes.create', compact('acts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'act_id' => ['required', \Illuminate\Validation\Rule::exists('acts', 'id')],
            'title' => ['required', 'string', 'max:255'],
        ]);
        Quiz::create($validated);
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz)
    {
        $acts = Act::with('chapter')->orderBy('chapter_id')->orderBy('order_number')->get();
        return view('admin.quizzes.edit', compact('quiz', 'acts'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'act_id' => ['required', \Illuminate\Validation\Rule::exists('acts', 'id')],
            'title' => ['required', 'string', 'max:255'],
        ]);
        $quiz->update($validated);
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz berhasil diupdate.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz berhasil dihapus.');
    }


     public function show(Quiz $quiz)
    {
        $quiz->load(['act', 'pairs']);
        return view('admin.quizzes.show', compact('quiz'));
    }
}
   
