<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    /**
     * GET /api/users
     * Ambil semua user
     */
    public function index()
    {
        try {
            $users = User::select('id', 'nickname', 'email', 'role', 'gender', 'tanggal_lahir', 'avatar', 'total_score', 'created_at')->get();

            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully',
                'data' => $users
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/users/{id}
     * Ambil detail user berdasarkan ID
     */
    public function show($id)
    {
        try {
            $user = User::select('id', 'nickname', 'email', 'role', 'gender', 'tanggal_lahir', 'avatar', 'total_score', 'created_at')
                ->find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/users
     * Tambah user baru
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nickname' => 'required|string|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Buat user baru
            $user = User::create([
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user' // default role
            ]);

            // Load user untuk response (tanpa password)
            $user = User::select('id', 'nickname', 'email', 'role', 'gender', 'tanggal_lahir', 'avatar', 'total_score', 'created_at')
                ->find($user->id);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /api/users/{id}
     * Update user
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Validasi input
            $validator = Validator::make($request->all(), [
                'nickname' => 'sometimes|required|string|max:255|unique:users,nickname,' . $id,
                'email' => 'sometimes|required|email|max:255|unique:users,email,' . $id,
                'password' => 'sometimes|string|min:6',
                'gender' => 'sometimes|in:male,female,other',
                'tanggal_lahir' => 'sometimes|date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Update field jika ada
            if ($request->has('nickname')) {
                $user->nickname = $request->nickname;
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            }

            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->has('gender')) {
                $user->gender = $request->gender;
            }

            if ($request->has('tanggal_lahir')) {
                $user->tanggal_lahir = $request->tanggal_lahir;
            }

            $user->save();

            // Load user untuk response (tanpa password)
            $user = User::select('id', 'nickname', 'email', 'role', 'gender', 'tanggal_lahir', 'avatar', 'total_score', 'updated_at')
                ->find($id);

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/users/{id}
     * Hapus user
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
