<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserQuizProgress;
use App\Services\QuizService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class UserQuizProgressApiController extends Controller
{
    protected QuizService $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }
    public function index()
    {
        try {
            $progress = UserQuizProgress::with([
                'user:id,nickname,email',
                'quiz:id,title',
            ])
                ->orderByDesc('completed_at')
                ->orderByDesc('id')
                ->get();

            return $this->successResponse('Data berhasil diambil', $progress);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function show($id)
    {
        try {
            $progress = UserQuizProgress::with([
                'user:id,nickname,email',
                'quiz:id,title',
            ])->find($id);

            if (!$progress) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            return $this->successResponse('Data berhasil diambil', $progress);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->validationRules($request));

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $progress = UserQuizProgress::create($validator->validated());
            $progress->load(['user:id,nickname,email', 'quiz:id,title']);

            return $this->successResponse('Data berhasil ditambahkan', $progress, 201);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal ditambahkan', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $progress = UserQuizProgress::find($id);

            if (!$progress) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $validator = Validator::make($request->all(), $this->validationRules($request, $progress->id));

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $progress->update($validator->validated());
            $progress->load(['user:id,nickname,email', 'quiz:id,title']);

            return $this->successResponse('Data berhasil diperbarui', $progress);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diperbarui', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $progress = UserQuizProgress::find($id);

            if (!$progress) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $progress->delete();

            return $this->successResponse('Data berhasil dihapus');
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal dihapus', 500);
        }
    }

    private function validationRules(Request $request, $ignoreId = null)
    {
        $progressRule = Rule::unique('user_quiz_progress', 'quiz_id')
            ->where(function ($query) use ($request) {
                return $query->where('user_id', $request->user_id);
            });

        if ($ignoreId !== null) {
            $progressRule->ignore($ignoreId);
        }

        return [
            'user_id' => 'required|exists:users,id',
            'quiz_id' => ['required', 'exists:quizzes,id', $progressRule],
            'score' => 'required|integer|min:0|max:100',
            'passed' => 'required|boolean',
            'completed_at' => 'nullable|date',
        ];
    }

    private function successResponse($message, $data = null, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    private function errorResponse($message, $status = 500, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status);
    }

    /**
     * POST /api/user-progress/submit-quiz
     * Submit jawaban quiz, hitung score otomatis, update progress & total_score.
     *
     * Request body:
     * {
     *   "user_id": 1,
     *   "quiz_id": 1,
     *   "answers": { "pair_id": "jawaban", ... }
     * }
     */
    public function submitQuiz(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'quiz_id' => 'required|exists:quizzes,id',
                'answers' => 'required|array',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $progress = $this->quizService->submitQuiz(
                $request->user_id,
                $request->quiz_id,
                $request->answers
            );

            $progress->load('quiz.act');
            $user = $progress->user()->first();

            // Cek apakah Act berikutnya terbuka setelah submit
            $nextActUnlocked = false;
            if ($progress->passed && $progress->quiz && $progress->quiz->act) {
                $currentAct = $progress->quiz->act;
                $nextAct = \App\Models\Act::where('chapter_id', $currentAct->chapter_id)
                    ->where('order_number', '>', $currentAct->order_number)
                    ->orderBy('order_number')
                    ->first();

                if ($nextAct) {
                    $nextActUnlocked = $this->quizService->isActUnlocked($request->user_id, $nextAct);
                }
            }

            return $this->successResponse('Quiz berhasil disubmit', [
                'progress_id' => $progress->id,
                'quiz_id' => $progress->quiz_id,
                'score' => $progress->score,
                'passed' => $progress->passed,
                'completed_at' => $progress->completed_at,
                'total_score' => $user->total_score,
                'next_act_unlocked' => $nextActUnlocked,
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse('Gagal submit quiz: ' . $e->getMessage(), 500);
        }
    }

    /**
     * GET /api/user-progress/summary/{userId}
     * Mendapatkan ringkasan progress belajar user.
     */
    public function userSummary($userId)
    {
        try {
            $summary = $this->quizService->getUserProgressSummary((int) $userId);

            return $this->successResponse('Data ringkasan progress berhasil diambil', $summary);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil: ' . $e->getMessage(), 500);
        }
    }
}
