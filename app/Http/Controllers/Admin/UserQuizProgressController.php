<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserQuizProgress;
use App\Models\User;
use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Http\Request;

class UserQuizProgressController extends Controller
{
    protected QuizService $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UserQuizProgress::with(['user', 'quiz']);

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nickname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('quiz', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        // Filter by passed status
        if ($request->has('filter') && $request->filter !== '') {
            if ($request->filter == 'passed') {
                $query->where('passed', true);
            } elseif ($request->filter == 'failed') {
                $query->where('passed', false);
            }
        }

        $progresses = $query->orderBy('completed_at', 'desc')->paginate(15);

        return view('admin.progresses.index', [
            'progresses' => $progresses,
            'search' => $request->search ?? '',
            'filter' => $request->filter ?? '',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('nickname')->get();
        $quizzes = Quiz::orderBy('title')->get();

        return view('admin.progresses.create', [
            'users' => $users,
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'score' => 'required|integer|min:0|max:100',
            'completed_at' => 'required|date',
        ]);

        // Tentukan status passed berdasarkan score
        $validated['passed'] = $validated['score'] >= 70;

        UserQuizProgress::updateOrCreate(
            [
                'user_id' => $validated['user_id'],
                'quiz_id' => $validated['quiz_id'],
            ],
            $validated
        );

        // Recalculate total_score user
        $this->quizService->recalculateTotalScore($validated['user_id']);

        return redirect()->route('admin.progresses.index')
            ->with('success', 'Progress quiz berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserQuizProgress $progress)
    {
        $progress->load(['user', 'quiz']);

        return view('admin.progresses.show', [
            'progress' => $progress,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserQuizProgress $progress)
    {
        $progress->load(['user', 'quiz']);

        return view('admin.progresses.edit', [
            'progress' => $progress,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserQuizProgress $progress)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'passed' => 'required|boolean',
            'completed_at' => 'required|date',
        ]);

        // Jika score diubah, update passed berdasarkan score
        if ($validated['score'] >= 70) {
            $validated['passed'] = true;
        } else {
            $validated['passed'] = false;
        }

        $progress->update($validated);

        // Recalculate total_score user
        $this->quizService->recalculateTotalScore($progress->user_id);

        return redirect()->route('admin.progresses.show', $progress->id)
            ->with('success', 'Progress quiz berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserQuizProgress $progress)
    {
        $userId = $progress->user_id;

        $progress->delete();

        // Recalculate total_score user setelah delete
        $this->quizService->recalculateTotalScore($userId);

        return redirect()->route('admin.progresses.index')
            ->with('success', 'Progress quiz berhasil dihapus');
    }
}
