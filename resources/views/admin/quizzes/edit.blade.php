@extends('layouts.admin')

@section('page-title', 'Edit Quiz')

@section('title', 'Admin - Edit Quiz')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Edit Quiz</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.quizzes.update', $quiz) }}" class="admin-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="act_id" class="admin-label">Pilih Act</label>
                    <select name="act_id" id="act_id" class="admin-select @if($errors->has('act_id')) is-invalid @endif" required>
                        <option value="">-- Pilih Act --</option>
                        @foreach($acts as $act)
                            <option value="{{ $act->id }}" {{ old('act_id', $quiz->act_id) == $act->id ? 'selected' : '' }}>
                                {{ $act->chapter->name }} - {{ $act->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('act_id'))
                        <span class="field-error">{{ $errors->first('act_id') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="title" class="admin-label">Judul Quiz</label>
                    <input type="text" name="title" id="title" class="admin-input @if($errors->has('title')) is-invalid @endif" value="{{ old('title', $quiz->title) }}" required>
                    @if($errors->has('title'))
                        <span class="field-error">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-actions">
                    <button class="btn btn-success" type="submit">Simpan</button>
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
