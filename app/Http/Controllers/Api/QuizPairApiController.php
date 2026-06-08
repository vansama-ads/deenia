<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuizPair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class QuizPairApiController extends Controller
{
    public function index()
    {
        try {
            $quizPairs = QuizPair::with('quiz')
                ->orderBy('quiz_id')
                ->orderBy('id')
                ->get();

            return $this->successResponse('Data berhasil diambil', $quizPairs);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function show($id)
    {
        try {
            $quizPair = QuizPair::with('quiz')->find($id);

            if (!$quizPair) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            return $this->successResponse('Data berhasil diambil', $quizPair);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->validationRules());

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $quizPair = QuizPair::create($validator->validated());
            $quizPair->load('quiz');

            return $this->successResponse('Data berhasil ditambahkan', $quizPair, 201);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal ditambahkan', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $quizPair = QuizPair::find($id);

            if (!$quizPair) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $validator = Validator::make($request->all(), $this->validationRules());

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $quizPair->update($validator->validated());
            $quizPair->load('quiz');

            return $this->successResponse('Data berhasil diperbarui', $quizPair);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diperbarui', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $quizPair = QuizPair::find($id);

            if (!$quizPair) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $quizPair->delete();

            return $this->successResponse('Data berhasil dihapus');
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal dihapus', 500);
        }
    }

    private function validationRules()
    {
        return [
            'quiz_id' => 'required|exists:quizzes,id',
            'left_text' => 'required|string',
            'right_text' => 'required|string',
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
