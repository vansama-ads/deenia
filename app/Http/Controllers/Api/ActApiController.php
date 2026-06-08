<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Act;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class ActApiController extends Controller
{
    public function index()
    {
        try {
            $acts = Act::with(['chapter', 'lessons', 'quizzes'])
                ->orderBy('chapter_id')
                ->orderBy('order_number')
                ->get();

            return $this->successResponse('Data berhasil diambil', $acts);
        } catch (Throwable $e) {
            return $this->errorResponse('Data gagal diambil', 500);
        }
    }

    public function show($id)
    {
        try {
            $act = Act::with(['chapter', 'lessons', 'quizzes'])->find($id);

            if (!$act) {
                return $this->errorResponse('Data tidak ditemukan', 404);
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
