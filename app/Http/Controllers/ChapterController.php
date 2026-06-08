<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\UserQuizProgress;
use App\Services\QuizService;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    /**
     * Display a listing of the chapters for USER (dengan progress).
     */
    public function userChapters()
    {
        $userId = auth()->id();
        $chapters = Chapter::with(['acts' => function($query) {
            $query->with(['quiz', 'lessons'])->orderBy('order_number');
        }])->orderBy('order_number')->get();

        // Map progress untuk setiap act
        $actProgress = [];
        foreach ($chapters as $chapter) {
            foreach ($chapter->acts as $act) {
                if ($act->quiz) {
                    $progress = UserQuizProgress::where('user_id', $userId)
                        ->where('quiz_id', $act->quiz->id)
                        ->first();
                    
                    $actProgress[$act->id] = [
                        'completed' => $progress ? true : false,
                        'passed' => $progress ? $progress->passed : false,
                        'score' => $progress ? $progress->score : 0,
                        'unlocked' => $this->quizService->isActUnlocked($userId, $act),
                    ];
                }
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'chapters' => $chapters,
                'act_progress' => $actProgress,
                'user_total_score' => auth()->user()->total_score,
            ],
        ]);
    }

    /**
     * Display a listing of the chapters. (ADMIN)
     */
    public function index()
    {
        $chapters = Chapter::orderBy('order_number')->get();
        return view('admin.chapters.index', compact('chapters'));
    }

    /**
     * Show the form for creating a new chapter.
     */
    public function create()
    {
        return view('admin.chapters.create');
    }

    /**
     * Store a newly created chapter in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'order_number' => 'required|integer|unique:chapters',
        ]);

        // Simpan ke database
        Chapter::create($validated);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified chapter.
     */
    public function edit(Chapter $chapter)
    {
        return view('admin.chapters.edit', compact('chapter'));
    }

    /**
     * Update the specified chapter in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'order_number' => 'required|integer|unique:chapters,order_number,' . $chapter->id,
        ]);

        // Update data
        $chapter->update($validated);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter berhasil diperbarui!');
    }

    /**
     * Remove the specified chapter from storage.
     */
    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter berhasil dihapus!');
    }
}
