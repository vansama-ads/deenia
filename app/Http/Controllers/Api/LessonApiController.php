<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class LessonApiController extends Controller
{
    public function index()
    {
        try {
            $lessons = Lesson::with('act')
                ->orderBy('act_id')
                ->orderBy('id')
                ->get();

            return $this->successResponse('Data berhasil diambil', $lessons);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function show($id)
    {
        try {
            $lesson = Lesson::with('act')->find($id);

            if (!$lesson) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            return $this->successResponse('Data berhasil diambil', $lesson);
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

            $lesson = Lesson::create($validator->validated());
            $lesson->load('act');

            return $this->successResponse('Data berhasil ditambahkan', $lesson, 201);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal ditambahkan', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $lesson = Lesson::find($id);

            if (!$lesson) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $validator = Validator::make($request->all(), $this->validationRules());

            if ($validator->fails()) {
                return $this->errorResponse('Validasi gagal', 422, $validator->errors());
            }

            $lesson->update($validator->validated());
            $lesson->load('act');

            return $this->successResponse('Data berhasil diperbarui', $lesson);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diperbarui', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $lesson = Lesson::find($id);

            if (!$lesson) {
                return $this->errorResponse('Data tidak ditemukan', 404);
            }

            $lesson->delete();

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
            'content' => 'required|string',
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
