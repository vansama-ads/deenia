@extends('layouts.admin')

@section('page-title', 'Edit Progress Quiz')

@section('title', 'Admin - Edit Progress Quiz')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <h2 class="card-title">Edit Progress Quiz</h2>
                <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.progresses.update', $progress->id) }}" method="POST" class="admin-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="admin-label">User</label>
                    <div class="readonly-field">
                        <strong>{{ $progress->user->nickname }}</strong> ({{ $progress->user->email }})
                    </div>
                </div>

                <div class="form-group">
                    <label class="admin-label">Quiz</label>
                    <div class="readonly-field">
                        <strong>{{ $progress->quiz->title }}</strong>
                    </div>
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
                        value="{{ old('score', $progress->score) }}"
                        class="admin-input @if($errors->has('score')) is-invalid @endif"
                    >
                    @if($errors->has('score'))
                        <span class="field-error">{{ $errors->first('score') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="passed" class="admin-label">Status Kelulusan</label>
                    <select name="passed" id="passed" class="admin-select @if($errors->has('passed')) is-invalid @endif" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="1" @if(old('passed', $progress->passed) == 1) selected @endif>Lulus</option>
                        <option value="0" @if(old('passed', $progress->passed) == 0) selected @endif>Tidak Lulus</option>
                    </select>
                    @if($errors->has('passed'))
                        <span class="field-error">{{ $errors->first('passed') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="completed_at" class="admin-label">Tanggal Selesai</label>
                    <input
                        type="datetime-local"
                        name="completed_at"
                        id="completed_at"
                        required
                        value="{{ old('completed_at', $progress->completed_at->format('Y-m-d\TH:i')) }}"
                        class="admin-input @if($errors->has('completed_at')) is-invalid @endif"
                    >
                    @if($errors->has('completed_at'))
                        <span class="field-error">{{ $errors->first('completed_at') }}</span>
                    @endif
                </div>

                <div class="note">
                    Score minimal 70 dinyatakan lulus. Di halaman ini status masih bisa disesuaikan manual.
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Update Progress</button>
                    <a href="{{ route('admin.progresses.show', $progress->id) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
