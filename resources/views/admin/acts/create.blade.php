@extends('layouts.admin')

@section('page-title', 'Tambah Act')

@section('title', 'Admin - Tambah Act')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">🎭 Tambah Act Baru</h2>
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
            <form action="{{ route('admin.acts.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="chapter_id" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Pilih Chapter <span style="color: red;">*</span>
                    </label>
                    <select id="chapter_id" name="chapter_id" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                        <option value="">-- Pilih Chapter --</option>
                        @foreach ($chapters as $chapter)
                            <option value="{{ $chapter->id }}" {{ old('chapter_id') == $chapter->id ? 'selected' : '' }}>
                                Era {{ $chapter->order_number }} - {{ $chapter->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('chapter_id')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Nama Act <span style="color: red;">*</span>
                    </label>
                    <input type="text" id="name" name="name" placeholder="Contoh: Act 1 - Pengenalan" 
                        style="width: 100%; padding: 10px; border: 1px solid {{ $errors->has('name') ? '#dc3545' : '#ddd' }}; border-radius: 4px; font-size: 14px;" 
                        value="{{ old('name') }}" required>
                    @error('name')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="description" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Deskripsi
                    </label>
                    <textarea id="description" name="description" placeholder="Masukkan deskripsi act..." 
                        style="width: 100%; padding: 10px; border: 1px solid {{ $errors->has('description') ? '#dc3545' : '#ddd' }}; border-radius: 4px; font-size: 14px; font-family: inherit;" 
                        rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="order_number" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Urutan <span style="color: red;">*</span>
                    </label>
                    <input type="number" id="order_number" name="order_number" placeholder="Contoh: 1" 
                        style="width: 100%; padding: 10px; border: 1px solid {{ $errors->has('order_number') ? '#dc3545' : '#ddd' }}; border-radius: 4px; font-size: 14px;" 
                        value="{{ old('order_number') }}" required>
                    <small style="display: block; margin-top: 5px; color: #666; font-size: 12px;">Masukkan nomor urutan act</small>
                    @error('order_number')
                        <span style="color: #dc3545; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; gap: 10px; margin-top: 30px;">
                    <a href="{{ route('admin.acts.index') }}" class="btn btn-secondary" style="padding: 10px 20px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; border-radius: 4px; background-color: #6c757d; color: white; border: none;">Batal</a>
                    <button type="submit" class="btn btn-primary" style="padding: 10px 20px; font-size: 14px; font-weight: 600; cursor: pointer; background-color: #667eea; color: white; border: none; border-radius: 4px;">Simpan Act</button>
                </div>
            </form>
        </div>
    </div>
@endsection
