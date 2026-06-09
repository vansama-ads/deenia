@extends('layouts.admin')

@section('page-title', 'Tambah Progress Quiz')

@section('title', 'Admin - Tambah Progress Quiz')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <h2 class="card-title">Tambah Progress Quiz Baru</h2>
                <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.progresses.store') }}" method="POST" class="admin-form">
                @csrf

                <div class="form-group">
                    <label for="user_id" class="admin-label">Pilih User</label>
                    <select name="user_id" id="user_id" class="admin-select @if($errors->has('user_id')) is-invalid @endif" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>
                                {{ $user->nickname }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('user_id'))
                        <span class="field-error">{{ $errors->first('user_id') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="quiz_id" class="admin-label">Pilih Quiz</label>
                    <select name="quiz_id" id="quiz_id" class="admin-select @if($errors->has('quiz_id')) is-invalid @endif" required>
                        <option value="">-- Pilih Quiz --</option>
                        @foreach($quizzes as $quiz)
                            <option value="{{ $quiz->id }}" @if(old('quiz_id') == $quiz->id) selected @endif>
                                {{ $quiz->title }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('quiz_id'))
                        <span class="field-error">{{ $errors->first('quiz_id') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="score" class="admin-label">Score (0-100)</label>
                    <input
                        type="number"
                        name="score"
                        id="score"
                        min="0"
                        max="100"
                        required
                        placeholder="Masukkan score"
                        value="{{ old('score') }}"
                        class="admin-input @if($errors->has('score')) is-invalid @endif"
                    >
                    @if($errors->has('score'))
                        <span class="field-error">{{ $errors->first('score') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="completed_at" class="admin-label">Tanggal Selesai</label>
                    <input
                        type="datetime-local"
                        name="completed_at"
                        id="completed_at"
                        required
                        value="{{ old('completed_at') }}"
                        class="admin-input @if($errors->has('completed_at')) is-invalid @endif"
                    >
                    @if($errors->has('completed_at'))
                        <span class="field-error">{{ $errors->first('completed_at') }}</span>
                    @endif
                </div>

                <div class="note">
                    Status kelulusan otomatis ditentukan dari score. Score minimal 70 dinyatakan lulus.
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan Progress</button>
                    <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
