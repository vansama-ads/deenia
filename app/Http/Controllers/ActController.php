<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Chapter;
use App\Models\UserQuizProgress;
use App\Services\QuizService;
use Illuminate\Http\Request;

class ActController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    /**
     * Show act untuk USER (dengan check unlock).
     */
    public function userShow(Act $act)
    {
        $userId = auth()->id();

        // Check apakah user bisa akses act ini
        if (!$this->quizService->isActUnlocked($userId, $act)) {
            $previousAct = $act->previousAct();
            return response()->json([
                'success' => false,
                'message' => 'Selesaikan Act sebelumnya terlebih dahulu!',
                'data' => [
                    'required_act' => $previousAct ? $previousAct->name : null,
                ],
            ], 403);
        }

        $act->load(['lessons' => function($query) {
            $query->orderBy('created_at');
        }, 'quiz']);

        $userId = auth()->id();
        $quizProgress = null;
        if ($act->quiz) {
            $quizProgress = UserQuizProgress::where('user_id', $userId)
                ->where('quiz_id', $act->quiz->id)
                ->first();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'act' => $act,
                'quiz_progress' => $quizProgress,
                'lessons_count' => $act->lessons->count(),
                'unlocked' => true,
            ],
        ]);
    }

    /**
     * Display a listing of acts grouped by chapters. (ADMIN)
     */
    public function index()
    {
        // Ambil semua chapters dengan acts-nya menggunakan eager loading
        $chapters = Chapter::with(['acts'])->orderBy('order_number')->get();

        return view('admin.acts.index', compact('chapters'));
    }

    /**
     * Show the form for creating a new act.
     */
    public function create()
    {
        $chapters = Chapter::orderBy('order_number')->get();
        return view('admin.acts.create', compact('chapters'));
    }

    /**
     * Store a newly created act in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'chapter_id' => 'required|exists:chapters,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_number' => 'required|integer',
        ]);

        // Simpan ke database
        Act::create($validated);

        return redirect()->route('admin.acts.index')
            ->with('success', 'Act berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified act.
     */
    public function edit(Act $act)
    {
        $chapters = Chapter::orderBy('order_number')->get();
        return view('admin.acts.edit', compact('act', 'chapters'));
    }

    /**
     * Update the specified act in storage.
     */
    public function update(Request $request, Act $act)
    {
        // Validasi
        $validated = $request->validate([
            'chapter_id' => 'required|exists:chapters,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_number' => 'required|integer',
        ]);

        // Update data
        $act->update($validated);

        return redirect()->route('admin.acts.index')
            ->with('success', 'Act berhasil diperbarui!');
    }

    /**
     * Remove the specified act from storage.
     */
    public function destroy(Act $act)
    {
        $act->delete();

        return redirect()->route('admin.acts.index')
            ->with('success', 'Act berhasil dihapus!');
    }
}
