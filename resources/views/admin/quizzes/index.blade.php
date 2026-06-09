@extends('layouts.admin')

@section('page-title', 'Kelola Quizzes')

@section('title', 'Admin - Quizzes')

@section('content')
<div class="page-actions mb-4">
    <div>
        <h2 class="section-title">Daftar Quizzes</h2>
        <hr class="section-underline">
    </div>
    <a href="{{ route('admin.quizzes.create') }}" class="btn btn-success">
        Tambah Quiz
    </a>
</div>

@forelse($quizzes as $chapterId => $actGroups)
    @php
        $chapter = $actGroups->first()->first()->act->chapter;
    @endphp
    
    <section class="section-group">
        <div class="section-banner">
            <h2 class="section-banner-title">Chapter {{ $chapter->order_number }} - {{ $chapter->name }}</h2>
            <span class="section-kicker">{{ $actGroups->sum(fn($actQuizzes) => $actQuizzes->count()) }} quiz</span>
        </div>

    @foreach($actGroups as $actId => $quizzesInAct)
        @php
            $act = $quizzesInAct->first()->act;
        @endphp
        
        <div class="subsection-banner">
            <h3 class="subsection-title">Act {{ $act->order_number }} - {{ $act->name }}</h3>
            <span class="section-kicker">{{ $quizzesInAct->count() }} quiz</span>
        </div>

        @foreach($quizzesInAct as $quiz)
            <div class="card quiz-card">
                <div class="card-header">
                    <div class="card-toolbar">
                        <h3 class="card-title">{{ $quiz->title }}</h3>
                        <div class="table-actions">
                            <a href="{{ route('admin.quizzes.show', $quiz) }}" class="btn btn-info btn-sm" title="Lihat detail">
                                Lihat
                            </a>
                            <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="btn btn-secondary btn-sm" title="Edit quiz">
                                Edit
                            </a>
                            <a href="{{ route('admin.quizzes.pairs.index', $quiz) }}" class="btn btn-primary btn-sm" title="Kelola pair">
                                Pair
                            </a>
                            <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" class="inline-form" onsubmit="return confirm('Yakin ingin menghapus quiz ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus quiz">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kiri</th>
                                    <th>Kanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quiz->pairs as $i => $pair)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ Str::limit($pair->left_text, 80, '...') }}</td>
                                        <td>{{ Str::limit($pair->right_text, 80, '...') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            Belum ada pair untuk quiz ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($quiz->pairs->count() > 0)
                        <div class="table-footer">
                            Total: <strong>{{ $quiz->pairs->count() }}</strong> pair
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endforeach
    </section>
@empty
    <div class="card">
        <div class="card-body">
            <div class="empty-state">
                <p>Belum ada quiz yang tersedia</p>
            </div>
        </div>
    </div>
@endforelse

@endsection
