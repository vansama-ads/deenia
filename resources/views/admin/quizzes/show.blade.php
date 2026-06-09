@extends('layouts.admin')

@section('page-title', 'Detail Quiz')

@section('title', 'Admin - Detail Quiz')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <h2 class="card-title">Detail Quiz: {{ $quiz->title }}</h2>
                <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <div class="detail-list mb-4">
                <div class="detail-item">
                    <span class="detail-label">Judul Quiz</span>
                    <p class="detail-value">{{ $quiz->title }}</p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Act</span>
                    <p class="detail-value">{{ $quiz->act?->name ?? '-' }}</p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jumlah Pair</span>
                    <p class="detail-value">{{ $quiz->pairs->count() }}</p>
                </div>
            </div>

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
                                <td>{{ $pair->left_text }}</td>
                                <td>{{ $pair->right_text }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada pair untuk quiz ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
