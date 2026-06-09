@extends('layouts.admin')

@section('page-title', 'Pair Soal Quiz')

@section('title', 'Admin - Pair Soal Quiz')

@section('content')
    <div class="page-actions mb-4">
        <div>
            <h2 class="section-title">Pair Soal Quiz</h2>
            <hr class="section-underline">
            <span class="section-kicker">{{ $quiz->title }}</span>
        </div>
        <div class="table-actions">
            <a href="{{ route('admin.quizzes.pairs.create', $quiz) }}" class="btn btn-success">Tambah Pair</a>
            <a href="{{ route('admin.quiz-pairs.index') }}" class="btn btn-secondary">Semua Pair</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Daftar Pair</h2>
        </div>
        <div class="card-body">
            @if($pairs->count() > 0)
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kiri</th>
                                <th>Kanan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pairs as $i => $pair)
                                <tr>
                                    <td>{{ $pairs->firstItem() + $i }}</td>
                                    <td>{{ $pair->left_text }}</td>
                                    <td>{{ $pair->right_text }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('admin.quizzes.pairs.edit', [$quiz, $pair]) }}" class="btn btn-sm btn-secondary">Edit</a>
                                            <form action="{{ route('admin.quizzes.pairs.destroy', [$quiz, $pair]) }}" method="POST" class="inline-form" onsubmit="return confirm('Hapus pair ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </div>
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
                    <p>Belum ada pair untuk quiz ini.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
