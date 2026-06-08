<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserQuizProgress;
use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    /**
     * Display the user's quiz progress.
     */
    public function myProgress()
    {
        $userId = Auth::id();
        
        $progresses = UserQuizProgress::where('user_id', $userId)
            ->with(['quiz', 'quiz.act', 'quiz.act.chapter'])
            ->orderBy('completed_at', 'desc')
            ->paginate(10);

        // Get summary statistics
        $totalQuizzes = Quiz::count();
        $completedQuizzes = $progresses->count();
        $passedQuizzes = UserQuizProgress::where('user_id', $userId)
            ->where('passed', true)
            ->count();
        $avgScore = UserQuizProgress::where('user_id', $userId)
            ->avg('score') ?? 0;

        $stats = [
            'total_quizzes' => $totalQuizzes,
            'completed_quizzes' => $completedQuizzes,
            'passed_quizzes' => $passedQuizzes,
            'failed_quizzes' => $completedQuizzes - $passedQuizzes,
            'avg_score' => round($avgScore, 2),
            'progress_percentage' => $totalQuizzes > 0 ? round(($passedQuizzes / $totalQuizzes) * 100) : 0,
            'total_score' => Auth::user()->total_score,
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'progresses' => $progresses,
                'stats' => $stats,
            ],
        ]);
    }
}
