<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizPair;
use Illuminate\Http\Request;

class QuizPairController extends Controller
{
    public function allIndex()
    {
        $pairs = QuizPair::with(['quiz.act.chapter'])
            ->latest()
            ->paginate(15);

        return view('admin.quizzes.pairs.all-index', compact('pairs'));
    }

    public function index(Quiz $quiz)
    {
        $pairs = $quiz->pairs()->paginate(10);
        return view('admin.quizzes.pairs.index', compact('quiz', 'pairs'));
    }

    public function create(Quiz $quiz)
    {
        return view('admin.quizzes.pairs.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'left_text' => ['required'],
            'right_text' => ['required'],
        ]);
        $quiz->pairs()->create($validated);
        return redirect()->route('admin.quizzes.pairs.index', $quiz)->with('success', 'Pair berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz, QuizPair $pair)
    {
        return view('admin.quizzes.pairs.edit', compact('quiz', 'pair'));
    }

    public function update(Request $request, Quiz $quiz, QuizPair $pair)
    {
        $validated = $request->validate([
            'left_text' => ['required'],
            'right_text' => ['required'],
        ]);
        $pair->update($validated);
        return redirect()->route('admin.quizzes.pairs.index', $quiz)->with('success', 'Pair berhasil diupdate.');
    }

    public function destroy(Quiz $quiz, QuizPair $pair)
    {
        $pair->delete();
        return redirect()->route('admin.quizzes.pairs.index', $quiz)->with('success', 'Pair berhasil dihapus.');
    }
}
