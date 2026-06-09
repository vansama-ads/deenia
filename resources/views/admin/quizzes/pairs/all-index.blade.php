@extends('layouts.admin')

@section('page-title', 'Quiz Pairs')

@section('title', 'Admin - Quiz Pairs')

@section('content')
    <div class="page-actions mb-4">
        <div>
            <h2 class="section-title">Daftar Quiz Pairs</h2>
            <hr class="section-underline">
        </div>
        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-success">Pilih Quiz</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Semua Pair Soal</h2>
        </div>
        <div class="card-body">
            @if($pairs->count() > 0)
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Quiz</th>
                                <th>Kiri</th>
                                <th>Kanan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pairs as $index => $pair)
                                <tr>
                                    <td>{{ ($pairs->currentPage() - 1) * $pairs->perPage() + $index + 1 }}</td>
                                    <td>
                                        <div class="cell-title">{{ $pair->quiz?->title ?? '-' }}</div>
                                        <div class="cell-muted">
                                            {{ $pair->quiz?->act?->chapter?->name ?? '-' }} / {{ $pair->quiz?->act?->name ?? '-' }}
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($pair->left_text, 80, '...') }}</td>
                                    <td>{{ Str::limit($pair->right_text, 80, '...') }}</td>
                                    <td>
                                        @if($pair->quiz)
                                            <div class="table-actions">
                                                <a href="{{ route('admin.quizzes.pairs.index', $pair->quiz) }}" class="btn btn-info btn-sm">Lihat</a>
                                                <a href="{{ route('admin.quizzes.pairs.edit', [$pair->quiz, $pair]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                                <form action="{{ route('admin.quizzes.pairs.destroy', [$pair->quiz, $pair]) }}" method="POST" class="inline-form" onsubmit="return confirm('Hapus pair ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted">Quiz tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrap">
                    {{ $pairs->links() }}
                </div>
            @else
                <div class="empty-state">
                    <p>Belum ada pair soal yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
