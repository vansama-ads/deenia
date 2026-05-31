@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            <i class="bi bi-bullseye"></i> Tambah Pair
        </h5>
        <form method="POST" action="{{ route('admin.quizzes.pairs.store', $quiz) }}">
            @csrf
            <div class="mb-3">
                <label for="left_text" class="form-label">Left Text</label>
                <textarea name="left_text" id="left_text" class="form-control" required>{{ old('left_text') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="right_text" class="form-label">Right Text</label>
                <textarea name="right_text" id="right_text" class="form-control" required>{{ old('right_text') }}</textarea>
            </div>
            <button class="btn btn-success" type="submit">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('admin.quizzes.pairs.index', $quiz) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
