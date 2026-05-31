@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            <i class="bi bi-bullseye"></i> Edit Quiz
        </h5>
        <form method="POST" action="{{ route('admin.quizzes.update', $quiz) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="act_id" class="form-label">Pilih Act</label>
                <select name="act_id" id="act_id" class="form-select" required>
                    <option value="">-- Pilih Act --</option>
                    @foreach($acts as $act)
                        <option value="{{ $act->id }}" {{ old('act_id', $quiz->act_id) == $act->id ? 'selected' : '' }}>
                            {{ $act->chapter->name }} - {{ $act->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Judul Quiz</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $quiz->title) }}" required>
            </div>
            <button class="btn btn-success" type="submit">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
