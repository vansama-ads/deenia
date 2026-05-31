@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Detail Quiz: {{ $quiz->title }}</h5>
        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Judul Quiz:</strong> {{ $quiz->title }}<br>
            <strong>Act:</strong> {{ $quiz->act?->name ?? '-' }}<br>
            <strong>Jumlah Pair:</strong> {{ $quiz->pairs->count() }}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
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
                            <td colspan="3">Belum ada pair untuk quiz ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
