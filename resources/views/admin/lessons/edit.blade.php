@extends('layouts.admin')

@section('page-title', 'Edit Lesson')

@section('title', 'Admin - Edit Lesson')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">📖 Edit Lesson</h2>
        </div>

        @if ($errors->any())
            <div style="margin: 15px; padding: 12px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; color: #721c24;">
                <strong>Error:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="padding: 20px;">
            <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 20px;">
                    <label for="act_id" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Pilih Act <span style="color: red;">*</span>
                    </label>
                    <select id="act_id" name="act_id" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                        <option value="">-- Pilih Act --</option>
                        @foreach ($acts as $act)
                            <option value="{{ $act->id }}" {{ old('act_id', $lesson->act_id) == $act->id ? 'selected' : '' }}>
                                {{ $act->chapter->name }} - {{ $act->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('act_id')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="title" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Judul Lesson <span style="color: red;">*</span>
                    </label>
                    <input type="text" id="title" name="title" placeholder="Contoh: Pengenalan Python" 
                        style="width: 100%; padding: 10px; border: 1px solid {{ $errors->has('title') ? '#dc3545' : '#ddd' }}; border-radius: 4px; font-size: 14px;" 
                        value="{{ old('title', $lesson->title) }}" required>
                    @error('title')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="content" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Konten <span style="color: red;">*</span>
                    </label>
                    <textarea id="content" name="content" placeholder="Masukkan konten lesson..." 
                        style="width: 100%; padding: 10px; border: 1px solid {{ $errors->has('content') ? '#dc3545' : '#ddd' }}; border-radius: 4px; font-size: 14px; font-family: inherit;" 
                        rows="10">{{ old('content', $lesson->content) }}</textarea>
                    <small style="display: block; margin-top: 5px; color: #666; font-size: 12px;">Anda dapat menggunakan HTML dan Markdown</small>
                    @error('content')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; gap: 10px; padding-top: 10px;">
                    <button type="submit" class="btn btn-primary">💾 Perbarui Lesson</button>
                    <a href="{{ route('admin.lessons.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
