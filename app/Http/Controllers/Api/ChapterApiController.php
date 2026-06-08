<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\UserQuizProgress;
use App\Services\QuizService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class ChapterApiController extends Controller
{
    protected QuizService $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }
    public function index(Request $request)
    {
        try {
            $chapters = Chapter::with(['acts' => function ($query) {
                $query->with(['lessons', 'quizzes'])->orderBy('order_number');
            }])
                ->orderBy('order_number')
                ->get();

            // Jika user_id diberikan, tambahkan is_unlocked dan quiz_progress per Act
            if ($request->has('user_id')) {
                $userId = (int) $request->user_id;
                $chapters = $chapters->map(function ($chapter) use ($userId) {
                    $chapter->acts = $chapter->acts->map(function ($act) use ($userId) {
                        $act->is_unlocked = $this->quizService->isActUnlocked($userId, $act);

                        // Ambil quiz progress user untuk Act ini
                        $quiz = $act->quizzes->first();
                        $act->quiz_progress = null;
                        if ($quiz) {
                            $progress = UserQuizProgress::where('user_id', $userId)
                                ->where('quiz_id', $quiz->id)
                                ->first();
                            if ($progress) {
                                $act->quiz_progress = [
                                    'score' => $progress->score,
                                    'passed' => $progress->passed,
                                    'completed_at' => $progress->completed_at,
                                ];
                            }
                        }

                        return $act;
                    });
                    return $chapter;
                });
            }

            return $this->successResponse('Data berhasil diambil', $chapters);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $chapter = Chapter::with(['acts' => function ($query) {
                $query->with(['lessons', 'quizzes'])->orderBy('order_number');
            }])->find($id);

            if (!$chapter) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            // Jika user_id diberikan, tambahkan is_unlocked dan quiz_progress per Act
            if ($request->has('user_id')) {
                $userId = (int) $request->user_id;
                $chapter->acts = $chapter->acts->map(function ($act) use ($userId) {
                    $act->is_unlocked = $this->quizService->isActUnlocked($userId, $act);

                    // Ambil quiz progress user untuk Act ini
                    $quiz = $act->quizzes->first();
                    $act->quiz_progress = null;
                    if ($quiz) {
                        $progress = UserQuizProgress::where('user_id', $userId)
                            ->where('quiz_id', $quiz->id)
                            ->first();
                        if ($progress) {
                            $act->quiz_progress = [
                                'score' => $progress->score,
                                'passed' => $progress->passed,
                                'completed_at' => $progress->completed_at,
                            ];
                        }
                    }

                    return $act;
                });
            }

            return $this->successResponse('Data berhasil diambil', $chapter);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'order_number' => 'required|integer|unique:chapters,order_number',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $chapter = Chapter::create($validator->validated());
            $chapter->load('acts');

            return $this->successResponse('Data berhasil ditambahkan', $chapter, 201);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal ditambahkan', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $chapter = Chapter::find($id);

            if (!$chapter) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'order_number' => [
                    'required',
                    'integer',
                    Rule::unique('chapters', 'order_number')->ignore($chapter->id),
                ],
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $chapter->update($validator->validated());
            $chapter->load('acts');

            return $this->successResponse('Data berhasil diperbarui', $chapter);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diperbarui', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $chapter = Chapter::find($id);

            if (!$chapter) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $chapter->delete();

            return $this->successResponse('Data berhasil dihapus');
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal dihapus', 500);
        }
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
}
