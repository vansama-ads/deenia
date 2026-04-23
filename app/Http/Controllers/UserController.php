<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Menentukan view path berdasarkan route prefix (admin atau user)
     */
    private function getViewPath($view)
    {
        // Cek apakah route berawalan 'admin.'
        if (strpos(request()->route()->getName(), 'admin.') === 0) {
            return 'admin.users.' . $view;
        }
        return 'users.' . $view;
    }

    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view($this->getViewPath('index'), compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view($this->getViewPath('create'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $isAdmin = strpos(request()->route()->getName(), 'admin.') === 0;

        if ($isAdmin) {
            // Validasi untuk admin (tanpa password confirmation)
            $request->validate([
                'nickname' => 'required|string|min:3|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|in:user,admin',
            ]);
        } else {
            // Validasi untuk user (dengan password confirmation)
            $request->validate([
                'nickname' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);
        }

        $user = User::create([
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $isAdmin ? $request->role : 'user',
            'gender' => $request->gender,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
        }

        $routeName = $isAdmin ? 'admin.users.index' : 'users.index';
        return redirect()->route($routeName)->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view($this->getViewPath('show'), compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view($this->getViewPath('edit'), compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $isAdmin = strpos(request()->route()->getName(), 'admin.') === 0;

        if ($isAdmin) {
            // Validasi untuk admin
            $request->validate([
                'nickname' => 'required|string|min:3|max:50',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required|in:user,admin',
            ]);

            $user->update([
                'nickname' => $request->nickname,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        } else {
            // Validasi untuk user
            $request->validate([
                'nickname' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            $data = $request->only(['nickname', 'email', 'gender', 'tanggal_lahir']);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    Storage::delete('public/' . $user->avatar);
                }
                $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }

            $user->update($data);
        }

        $routeName = $isAdmin ? 'admin.users.index' : 'users.index';
        return redirect()->route($routeName)->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $isAdmin = strpos(request()->route()->getName(), 'admin.') === 0;

        // Hapus avatar jika ada
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        $user->delete();

        $routeName = $isAdmin ? 'admin.users.index' : 'users.index';
        return redirect()->route($routeName)->with('success', 'User berhasil dihapus!');
    }

    /**
     * Update the user's role.
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin,moderator',
        ]);

        $user = User::findOrFail($id);
        $isAdmin = strpos(request()->route()->getName(), 'admin.') === 0;

        $user->update(['role' => $request->role]);

        $routeName = $isAdmin ? 'admin.users.index' : 'users.index';
        return redirect()->route($routeName)->with('success', 'Role user berhasil diperbarui!');
    }
}