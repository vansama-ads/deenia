@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            <i class="bi bi-bullseye"></i> Edit Pair
        </h5>
        <form method="POST" action="{{ route('admin.quizzes.pairs.update', [$quiz, $pair]) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="left_text" class="form-label">Left Text</label>
                <textarea name="left_text" id="left_text" class="form-control" required>{{ old('left_text', $pair->left_text) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="right_text" class="form-label">Right Text</label>
                <textarea name="right_text" id="right_text" class="form-control" required>{{ old('right_text', $pair->right_text) }}</textarea>
            </div>
            <button class="btn btn-success" type="submit">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('admin.quizzes.pairs.index', $quiz) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
