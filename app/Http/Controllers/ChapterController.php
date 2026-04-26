<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the chapters.
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
