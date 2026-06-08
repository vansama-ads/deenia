<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Act;
use App\Models\Quiz;
use App\Models\UserQuizProgress;
use App\Services\QuizService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class ActApiController extends Controller
{
    protected QuizService $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }
    public function index(Request $request)
    {
        try {
            $acts = Act::with(['chapter', 'lessons', 'quizzes'])
                ->orderBy('chapter_id')
                ->orderBy('order_number')
                ->get();

            // Jika user_id diberikan, tambahkan status unlock dan quiz progress
            if ($request->has('user_id')) {
                $userId = (int) $request->user_id;
                $acts = $acts->map(function ($act) use ($userId) {
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

            return $this->successResponse('Data berhasil diambil', $acts);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $act = Act::with(['chapter', 'lessons', 'quizzes'])->find($id);

            if (!$act) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            // Jika user_id diberikan, cek anti-skip
            if ($request->has('user_id')) {
                $userId = (int) $request->user_id;
                $isUnlocked = $this->quizService->isActUnlocked($userId, $act);

                if (!$isUnlocked) {
                    return $this->errorResponse('Selesaikan Act sebelumnya terlebih dahulu.', 403);
                }

                $act->is_unlocked = true;

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
            }

            return $this->successResponse('Data berhasil diambil', $act);
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

            $act = Act::create($validator->validated());
            $act->load(['chapter', 'lessons', 'quizzes']);

            return $this->successResponse('Data berhasil ditambahkan', $act, 201);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal ditambahkan', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $act = Act::find($id);

            if (!$act) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $validator = Validator::make($request->all(), $this->validationRules($request, $act->id));

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $act->update($validator->validated());
            $act->load(['chapter', 'lessons', 'quizzes']);

            return $this->successResponse('Data berhasil diperbarui', $act);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diperbarui', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $act = Act::find($id);

            if (!$act) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $act->delete();

            return $this->successResponse('Data berhasil dihapus');
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal dihapus', 500);
        }
    }

    private function validationRules(Request $request, $ignoreId = null)
    {
        $orderRule = Rule::unique('acts', 'order_number')
            ->where(function ($query) use ($request) {
                return $query->where('chapter_id', $request->chapter_id);
            });

        if ($ignoreId !== null) {
            $orderRule->ignore($ignoreId);
        }

        return [
            'chapter_id' => 'required|exists:chapters,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_number' => ['required', 'integer', $orderRule],
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
}
