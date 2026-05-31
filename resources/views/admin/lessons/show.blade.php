@extends('layouts.admin')

@section('page-title', $lesson->title)

@section('title', 'Admin - ' . $lesson->title)

@section('content')
    <style>
        .markdown-content h1, 
        .markdown-content h2, 
        .markdown-content h3 {
            color: #1a1a1a;
            font-weight: 600;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
            padding-bottom: 0.3em;
            border-bottom: 2px solid #667eea;
        }

        .markdown-content h1 {
            font-size: 1.8rem;
            border-bottom: 3px solid #667eea;
        }

        .markdown-content h2 {
            font-size: 1.5rem;
        }

        .markdown-content h3 {
            font-size: 1.2rem;
        }

        .markdown-content p {
            margin-bottom: 1em;
            text-align: justify;
        }

        .markdown-content ul, 
        .markdown-content ol {
            margin: 1em 0;
            margin-left: 2em;
        }

        .markdown-content li {
            margin-bottom: 0.5em;
        }

        .markdown-content strong {
            color: #667eea;
            font-weight: 700;
        }

        .markdown-content em {
            font-style: italic;
            color: #555;
        }

        .markdown-content code {
            background-color: #f4f4f4;
            padding: 0.2em 0.4em;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            color: #d63384;
        }
    </style>
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
            <div class="markdown-content" style="margin-bottom: 30px; line-height: 1.8; color: #333; font-size: 1rem;">
                {!! \Illuminate\Support\Str::markdown($lesson->content) !!}
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
