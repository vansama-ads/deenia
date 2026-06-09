@extends('layouts.admin')

@section('page-title', 'Edit Lesson')

@section('title', 'Admin - Edit Lesson')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Edit Lesson</h2>
        </div>

        <div class="admin-card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST" class="admin-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="act_id">Pilih Act <span class="required">*</span></label>
                    <select id="act_id" name="act_id" class="form-select @error('act_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Act --</option>
                        @foreach ($acts as $act)
                            <option value="{{ $act->id }}" {{ old('act_id', $lesson->act_id) == $act->id ? 'selected' : '' }}>
                                {{ $act->chapter->name }} - {{ $act->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('act_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">Judul Lesson <span class="required">*</span></label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Contoh: Pengenalan Python" value="{{ old('title', $lesson->title) }}" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Konten <span class="required">*</span></label>
                    <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror"
                        placeholder="Masukkan konten lesson..." rows="10">{{ old('content', $lesson->content) }}</textarea>
                    <small class="form-text">Anda dapat menggunakan HTML dan Markdown</small>
                    @error('content')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Perbarui Lesson</button>
                    <a href="{{ route('admin.lessons.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
