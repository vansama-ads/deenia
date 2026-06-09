<?php

namespace App\Services;

use App\Models\Act;
use App\Models\Quiz;
use App\Models\User;
use App\Models\UserQuizProgress;
use Illuminate\Support\Facades\DB;

class QuizService
{
    /**
     * Submit quiz answers, calculate score, update progress and user total_score.
     */
    public function submitQuiz(int $userId, int $quizId, array $answers): UserQuizProgress
    {
        $quiz = Quiz::with('pairs')->findOrFail($quizId);

        $correct = 0;
        foreach ($quiz->pairs as $pair) {
            if (isset($answers[$pair->id]) && $answers[$pair->id] === $pair->right_text) {
                $correct++;
            }
        }
        $total = $quiz->pairs->count();
        $score = $total > 0 ? intval(($correct / $total) * 100) : 0;
        $passed = $score >= 70;

        return DB::transaction(function () use ($userId, $quizId, $score, $passed) {
            $progress = UserQuizProgress::updateOrCreate(
                [
                    'user_id' => $userId,
                    'quiz_id' => $quizId,
                ],
                [
                    'user_id' => $userId,
                    'quiz_id' => $quizId,
                    'score' => $score,
                    'passed' => $passed,
                    'completed_at' => now(),
                ]
            );

            $this->recalculateTotalScore($userId);

            return $progress;
        });
    }

    /**
     * Cek apakah Act sudah selesai (quiz lulus)
     */
    public function isActCompleted(int $userId, int $actId): bool
    {
        $quiz = Quiz::where('act_id', $actId)->first();
        if (!$quiz) return false;

        $progress = UserQuizProgress::where('user_id', $userId)
            ->where('quiz_id', $quiz->id)
            ->where('passed', true)
            ->first();

        return $progress !== null;
    }

    /**
     * Hitung ulang total_score user dari SUM seluruh user_quiz_progress.
     * Digunakan oleh admin controller saat CRUD progress manual.
     */
    public function recalculateTotalScore(int $userId): int
    {
        $totalScore = UserQuizProgress::where('user_id', $userId)->sum('score');

        User::where('id', $userId)->update(['total_score' => $totalScore]);

        return (int) $totalScore;
    }

    /**
     * Cek apakah sebuah Act terbuka untuk user.
     *
     * Rules:
     * - Act pertama dalam chapter (order_number terkecil) selalu terbuka.
     * - Act berikutnya terbuka jika quiz Act sebelumnya passed = true.
     */
    public function isActUnlocked(int $userId, Act $act): bool
    {
        $previousAct = $act->previousAct();

        // Act pertama selalu terbuka
        if (!$previousAct) {
            return true;
        }

        // Cek apakah quiz Act sebelumnya sudah lulus
        return $this->isActCompleted($userId, $previousAct->id);
    }

    /**
     * Mendapatkan ringkasan progress belajar user.
     * Digunakan oleh frontend untuk menampilkan dashboard progress.
     */
    public function getUserProgressSummary(int $userId): array
    {
        $user = User::findOrFail($userId);

        $totalQuizzes = Quiz::count();
        $progressRecords = UserQuizProgress::where('user_id', $userId)->get();
        $completedQuizzes = $progressRecords->count();
        $passedQuizzes = $progressRecords->where('passed', true)->count();
        $progressPercentage = $totalQuizzes > 0
            ? round(($passedQuizzes / $totalQuizzes) * 100, 1)
            : 0;

        return [
            'user_id' => $userId,
            'nickname' => $user->nickname,
            'total_score' => $user->total_score,
            'total_quizzes' => $totalQuizzes,
            'completed_quizzes' => $completedQuizzes,
            'passed_quizzes' => $passedQuizzes,
            'progress_percentage' => $progressPercentage,
            'quiz_details' => $progressRecords->load('quiz:id,title,act_id')->toArray(),
        ];
    }
}
