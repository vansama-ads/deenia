<?php

namespace App\Services;

use App\Models\Quiz;
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

        // Hitung score
        $correct = 0;
        foreach ($quiz->pairs as $pair) {
            if (isset($answers[$pair->id]) && $answers[$pair->id] === $pair->right_text) {
                $correct++;
            }
        }
        $total = $quiz->pairs->count();
        $score = $total > 0 ? intval(($correct / $total) * 100) : 0;
        $passed = $score >= 70;

        // Transaction untuk update progress & total_score
        return DB::transaction(function () use ($userId, $quizId, $score, $passed) {
            $progress = UserQuizProgress::where('user_id', $userId)
                ->where('quiz_id', $quizId)
                ->first();

            $now = now();

            if ($progress) {
                if ($score > $progress->score) {
                    $scoreDiff = $score - $progress->score;
                    $progress->update([
                        'score' => $score,
                        'passed' => $passed,
                        'completed_at' => $now,
                    ]);
                    $progress->user->increment('total_score', $scoreDiff);
                }
            } else {
                $progress = UserQuizProgress::create([
                    'user_id' => $userId,
                    'quiz_id' => $quizId,
                    'score' => $score,
                    'passed' => $passed,
                    'completed_at' => $now,
                ]);
                $progress->user->increment('total_score', $score);
            }

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
}
