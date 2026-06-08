<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class QuizApiController extends Controller
{
    public function index()
    {
        try {
            $quizzes = Quiz::with(['act', 'pairs'])
                ->orderBy('act_id')
                ->orderBy('id')
                ->get();

            return $this->successResponse('Data berhasil diambil', $quizzes);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function show($id)
    {
        try {
            $quiz = Quiz::with(['act', 'pairs'])->find($id);

            if (!$quiz) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            return $this->successResponse('Data berhasil diambil', $quiz);
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

            $quiz = Quiz::create($validator->validated());
            $quiz->load(['act', 'pairs']);

            return $this->successResponse('Data berhasil ditambahkan', $quiz, 201);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal ditambahkan', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $quiz = Quiz::find($id);

            if (!$quiz) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $validator = Validator::make($request->all(), $this->validationRules());

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $quiz->update($validator->validated());
            $quiz->load(['act', 'pairs']);

            return $this->successResponse('Data berhasil diperbarui', $quiz);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diperbarui', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $quiz = Quiz::find($id);

            if (!$quiz) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $quiz->delete();

            return $this->successResponse('Data berhasil dihapus');
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal dihapus', 500);
        }
    }

    private function validationRules()
    {
        return [
            'act_id' => 'required|exists:acts,id',
            'title' => 'required|string|max:255',
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
