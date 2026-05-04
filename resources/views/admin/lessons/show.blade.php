@extends('layouts.admin')

@section('page-title', $lesson->title)

@section('title', 'Admin - ' . $lesson->title)

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h2 class="card-title">📖 {{ $lesson->title }}</h2>
                    <small style="color: #666; display: block; margin-top: 5px;">
                        Chapter: <strong>{{ $lesson->act->chapter->name }}</strong> | 
                        Act: <strong>{{ $lesson->act->name }}</strong>
                    </small>
                </div>
            </div>
        </div>

        <div style="padding: 20px;">
            <!-- Konten Lesson -->
            <div style="margin-bottom: 30px; line-height: 1.6; color: #333;">
                {!! $lesson->content !!}
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; gap: 10px; padding-top: 20px; border-top: 1px solid #ddd;">
                <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-secondary" style="padding: 10px 15px; background: #6c757d; color: white; text-decoration: none; border: none; border-radius: 3px; cursor: pointer; display: inline-block;">✏️ Edit Lesson</a>
                <a href="{{ route('admin.lessons.index') }}" class="btn btn-secondary" style="padding: 10px 15px; background: #667eea; color: white; text-decoration: none; border: none; border-radius: 3px; cursor: pointer; display: inline-block;">⬅️ Kembali ke Daftar</a>
                <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus lesson ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding: 10px 15px; background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer;">🗑️ Hapus Lesson</button>
                </form>
            </div>
        </div>
    </div>
@endsection
