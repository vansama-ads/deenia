<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private const DEFAULT_AVATAR = 'avatars/default.jpg';

    /**
     * Menentukan view path berdasarkan route prefix (admin atau user)
     */
    private function getViewPath($view)
    {
        // Cek apakah route berawalan 'admin.'
        if ($this->isAdminRoute()) {
            return 'admin.users.' . $view;
        }
        return 'users.' . $view;
    }

    private function isAdminRoute(): bool
    {
        return strpos(request()->route()?->getName() ?? '', 'admin.') === 0;
    }

    private function ensureOwnProfile(int|string $id): void
    {
        abort_if((int) $id !== (int) auth()->id(), 403);
    }

    private function buildProfilePayload(User $user): array
    {
        $latestProgress = $user->quizProgress()
            ->with(['quiz.act.chapter'])
            ->whereHas('quiz.act.chapter')
            ->orderByDesc('completed_at')
            ->orderByDesc('updated_at')
            ->first();

        $progressRecords = $user->quizProgress()->get();
        $totalQuizzes = Quiz::count();
        $completedQuizzes = $progressRecords->count();
        $passedQuizzes = $progressRecords->where('passed', true)->count();

        return [
            'latestProgress' => $latestProgress,
            'currentQuiz' => $latestProgress?->quiz,
            'currentAct' => $latestProgress?->quiz?->act,
            'currentChapter' => $latestProgress?->quiz?->act?->chapter,
            'progressSummary' => [
                'total_quizzes' => $totalQuizzes,
                'completed_quizzes' => $completedQuizzes,
                'passed_quizzes' => $passedQuizzes,
                'progress_percentage' => $totalQuizzes > 0 ? round(($passedQuizzes / $totalQuizzes) * 100) : 0,
            ],
        ];
    }

    private function deleteCustomAvatar(?string $avatar): void
    {
        if (!$avatar || $avatar === self::DEFAULT_AVATAR) {
            return;
        }

        if (Storage::disk('b2')->exists($avatar)) {
            Storage::disk('b2')->delete($avatar);
        }
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
                'tanggal_lahir' => 'nullable|date',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } else {
            // Validasi untuk user (dengan password confirmation)
            $request->validate([
                'nickname' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'tanggal_lahir' => 'nullable|date',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $path = $request->file('avatar')->store('avatars', 'b2');
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
        if (!$this->isAdminRoute()) {
            $this->ensureOwnProfile($id);

            $user = auth()->user()->fresh();

            return view('user.profile', [
                'user' => $user,
                ...$this->buildProfilePayload($user),
            ]);
        }

        $user = User::findOrFail($id);
        return view($this->getViewPath('show'), compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        if (!$this->isAdminRoute()) {
            $this->ensureOwnProfile($id);

            return redirect()->route('users.show', auth()->id());
        }

        $user = User::findOrFail($id);
        return view($this->getViewPath('edit'), compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $isAdmin = $this->isAdminRoute();

        if ($isAdmin) {
            // Validasi untuk admin
            $request->validate([
                'nickname' => 'required|string|min:3|max:50',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required|in:user,admin',
                'tanggal_lahir' => 'nullable|date',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = [
                'nickname' => $request->nickname,
                'email' => $request->email,
                'role' => $request->role,
                'tanggal_lahir' => $request->tanggal_lahir,
            ];

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    Storage::delete('b2' . $user->avatar);
                }
                $data['avatar'] = $request->file('avatar')->store('avatars', 'b2');
            }

            $user->update($data);
        } else {
            $this->ensureOwnProfile($id);

            // Validasi untuk user
            $validated = $request->validate([
                'nickname' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('users', 'nickname')->ignore($user->id),
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],
                'gender' => ['nullable', Rule::in(['male', 'female'])],
                'tanggal_lahir' => ['nullable', 'date'],
                'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            ]);

            $data = [
                'nickname' => $validated['nickname'],
                'email' => $validated['email'],
                'gender' => $validated['gender'] ?? null,
                'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            ];

            if ($request->hasFile('avatar')) {
                $data['avatar'] = $request->file('avatar')->store('avatars', 'b2');
                $this->deleteCustomAvatar($user->avatar);
            }

            $user->update($data);

            return redirect()->route('users.show', $user->id)->with('success', 'Profil berhasil diperbarui!');
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
        $isAdmin = $this->isAdminRoute();

        // Hapus avatar jika ada
        if ($user->avatar) {
            Storage::delete('b2' . $user->avatar);
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
        abort_if(!$this->isAdminRoute(), 403);

        $request->validate([
            'role' => 'required|in:user,admin,moderator',
        ]);

        $user = User::findOrFail($id);
        $isAdmin = $this->isAdminRoute();

        $user->update(['role' => $request->role]);

        $routeName = $isAdmin ? 'admin.users.index' : 'users.index';
        return redirect()->route($routeName)->with('success', 'Role user berhasil diperbarui!');
    }
}
