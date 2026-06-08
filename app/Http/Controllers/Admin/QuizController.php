<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Act;
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
    public function userShow(Quiz $quiz)
    {
        $userId = auth()->id();
        $act = $quiz->act;

        // Check apakah user bisa akses quiz ini (via act unlock)
        if (!$this->quizService->isActUnlocked($userId, $act)) {
            $previousAct = $act->previousAct();
            return response()->json([
                'success' => false,
                'message' => 'Selesaikan Act sebelumnya terlebih dahulu!',
                'data' => [
                    'required_act' => $previousAct ? $previousAct->name : null,
                ],
            ], 403);
        }

        $quiz->load('pairs');

        $previousProgress = UserQuizProgress::where('user_id', $userId)
            ->where('quiz_id', $quiz->id)
            ->first();

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

    /**
     * Submit quiz answers dari USER.
     */
    public function userSubmit(Request $request, Quiz $quiz)
    {
        $userId = auth()->id();
        $act = $quiz->act;

        // Check unlock
        if (!$this->quizService->isActUnlocked($userId, $act)) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak!',
            ], 403);
        }

        // Validasi input
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        try {
            // Submit via QuizService
            $progress = $this->quizService->submitQuiz($userId, $quiz->id, $validated['answers']);

            return response()->json([
                'success' => true,
                'message' => 'Quiz berhasil disubmit!',
                'data' => [
                    'score' => $progress->score,
                    'passed' => $progress->passed,
                    'message' => $progress->passed 
                        ? 'Selamat! Anda lulus dengan score ' . $progress->score
                        : 'Coba lagi. Score Anda ' . $progress->score,
                    'progress' => $progress,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
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
   