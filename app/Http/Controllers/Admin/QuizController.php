<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Act;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        // Get all quizzes grouped by chapter and act
        $quizzes = Quiz::with(['act.chapter', 'pairs'])
            ->whereHas('act')
            ->orderBy('act_id')
            ->get()
            ->groupBy(function ($quiz) {
                return $quiz->act->chapter_id;
            })
            ->map(function ($chapterQuizzes) {
                return $chapterQuizzes->groupBy(function ($quiz) {
                    return $quiz->act_id;
                });
            });
        
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $acts = Act::with('chapter')->orderBy('chapter_id')->orderBy('order_number')->get();
        return view('admin.quizzes.create', compact('acts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'act_id' => ['required', \Illuminate\Validation\Rule::exists('acts', 'id')],
            'title' => ['required', 'string', 'max:255'],
        ]);
        Quiz::create($validated);
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz)
    {
        $acts = Act::with('chapter')->orderBy('chapter_id')->orderBy('order_number')->get();
        return view('admin.quizzes.edit', compact('quiz', 'acts'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'act_id' => ['required', \Illuminate\Validation\Rule::exists('acts', 'id')],
            'title' => ['required', 'string', 'max:255'],
        ]);
        $quiz->update($validated);
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz berhasil diupdate.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz berhasil dihapus.');
    }


     public function show(Quiz $quiz)
    {
        $quiz->load(['act', 'pairs']);
        return view('admin.quizzes.show', compact('quiz'));
    }
}
   