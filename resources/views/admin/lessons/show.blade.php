@extends('layouts.admin')

@section('page-title', $lesson->title)

@section('title', 'Admin - ' . $lesson->title)

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <div>
                    <h2 class="card-title">{{ $lesson->title }}</h2>
                    <small class="section-kicker">
                        Chapter: <strong>{{ $lesson->act->chapter->name }}</strong> |
                        Act: <strong>{{ $lesson->act->name }}</strong>
                    </small>
                </div>
            </div>
        </div>

        <div class="admin-card-body">
            <div class="markdown-content">
                {!! \Illuminate\Support\Str::markdown($lesson->content) !!}
            </div>

            <div class="form-actions lesson-actions">
                <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-edit">Edit Lesson</a>
                <a href="{{ route('admin.lessons.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
                <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Yakin ingin menghapus lesson ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Lesson</button>
                </form>
            </div>
        </div>
    </div>
@endsection
