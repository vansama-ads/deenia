<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\UserQuizProgress;
use App\Services\QuizService;
use Illuminate\Support\Collection;

class LearnController extends Controller
{
    public function __construct(private readonly QuizService $quizService)
    {
    }

    public function index()
    {
        $user = auth()->user();
        $userId = $user->id;

        $chapters = Chapter::with([
            'acts' => function ($query) {
                $query->with([
                    'lessons' => fn ($lessonQuery) => $lessonQuery->orderBy('id'),
                    'quiz',
                ])->orderBy('order_number');
            },
        ])->orderBy('order_number')->get();

        $quizProgress = UserQuizProgress::where('user_id', $userId)
            ->get()
            ->keyBy('quiz_id');

        $activeChapter = $this->resolveActiveChapter($chapters, $quizProgress);
        $activeAct = $this->resolveActiveAct($activeChapter, $userId, $quizProgress);
        $actStateById = $this->actStateById($chapters, $userId, $quizProgress);
        $lessonCompletionByAct = $this->lessonCompletionByAct($chapters, $quizProgress);
        $summary = $this->buildSummary($chapters, $quizProgress, $lessonCompletionByAct);

        return view('user.learn', [
            'user' => $user,
            'chapters' => $chapters,
            'activeChapter' => $activeChapter,
            'activeAct' => $activeAct,
            'actStateById' => $actStateById,
            'lessonCompletionByAct' => $lessonCompletionByAct,
            'summary' => $summary,
            'userLevel' => $this->resolveUserLevel((int) $user->total_score),
        ]);
    }

    private function resolveActiveChapter(Collection $chapters, Collection $quizProgress): ?Chapter
    {
        return $chapters->first(function (Chapter $chapter) use ($quizProgress) {
            return $chapter->acts->contains(function ($act) use ($quizProgress) {
                return !$this->isActQuizPassed($act, $quizProgress);
            });
        }) ?? $chapters->first();
    }

    private function resolveActiveAct(?Chapter $chapter, int $userId, Collection $quizProgress)
    {
        if (!$chapter) {
            return null;
        }

        return $chapter->acts->first(function ($act) use ($userId, $quizProgress) {
            return $this->quizService->isActUnlocked($userId, $act)
                && !$this->isActQuizPassed($act, $quizProgress);
        }) ?? $chapter->acts->last();
    }

    private function lessonCompletionByAct(Collection $chapters, Collection $quizProgress): array
    {
        return $chapters
            ->flatMap(fn (Chapter $chapter) => $chapter->acts)
            ->mapWithKeys(fn ($act) => [$act->id => $this->isActQuizPassed($act, $quizProgress)])
            ->all();
    }

    private function actStateById(Collection $chapters, int $userId, Collection $quizProgress): array
    {
        return $chapters
            ->flatMap(fn (Chapter $chapter) => $chapter->acts)
            ->mapWithKeys(function ($act) use ($userId, $quizProgress) {
                return [
                    $act->id => [
                        'unlocked' => $this->quizService->isActUnlocked($userId, $act),
                        'completed' => $this->isActQuizPassed($act, $quizProgress),
                        'quiz_progress' => $act->quiz ? $quizProgress->get($act->quiz->id) : null,
                    ],
                ];
            })
            ->all();
    }

    private function buildSummary(Collection $chapters, Collection $quizProgress, array $lessonCompletionByAct): array
    {
        $totalQuizzes = Quiz::count();
        $completedQuizzes = $quizProgress->count();
        $passedQuizzes = $quizProgress->where('passed', true)->count();
        $totalLessons = Lesson::count();
        $completedLessons = $chapters
            ->flatMap(fn (Chapter $chapter) => $chapter->acts)
            ->filter(fn ($act) => $lessonCompletionByAct[$act->id] ?? false)
            ->sum(fn ($act) => $act->lessons->count());

        return [
            'total_quizzes' => $totalQuizzes,
            'completed_quizzes' => $completedQuizzes,
            'passed_quizzes' => $passedQuizzes,
            'total_lessons' => $totalLessons,
            'completed_lessons' => $completedLessons,
            'progress_percentage' => $totalQuizzes > 0 ? round(($passedQuizzes / $totalQuizzes) * 100) : 0,
        ];
    }

    private function isActQuizPassed($act, Collection $quizProgress): bool
    {
        if (!$act->quiz) {
            return false;
        }

        return (bool) optional($quizProgress->get($act->quiz->id))->passed;
    }

    private function resolveUserLevel(int $totalScore): int
    {
        return max(1, intdiv($totalScore, 500) + 1);
    }
}
