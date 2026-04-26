<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ActController extends Controller
{
    /**
     * Display a listing of acts grouped by chapters.
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
