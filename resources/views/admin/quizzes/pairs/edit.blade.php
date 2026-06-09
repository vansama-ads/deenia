@extends('layouts.admin')

@section('page-title', 'Edit Pair')

@section('title', 'Admin - Edit Pair')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Edit Pair</h2>
            <span class="section-kicker">{{ $quiz->title }}</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.quizzes.pairs.update', [$quiz, $pair]) }}" class="admin-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="left_text" class="admin-label">Left Text</label>
                    <textarea name="left_text" id="left_text" class="admin-textarea @if($errors->has('left_text')) is-invalid @endif" required>{{ old('left_text', $pair->left_text) }}</textarea>
                    @if($errors->has('left_text'))
                        <span class="field-error">{{ $errors->first('left_text') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="right_text" class="admin-label">Right Text</label>
                    <textarea name="right_text" id="right_text" class="admin-textarea @if($errors->has('right_text')) is-invalid @endif" required>{{ old('right_text', $pair->right_text) }}</textarea>
                    @if($errors->has('right_text'))
                        <span class="field-error">{{ $errors->first('right_text') }}</span>
                    @endif
                </div>
                <div class="form-actions">
                    <button class="btn btn-success" type="submit">Simpan</button>
                    <a href="{{ route('admin.quizzes.pairs.index', $quiz) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
