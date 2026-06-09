@extends('layouts.admin')

@section('page-title', 'Tambah Act')

@section('title', 'Admin - Tambah Act')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Tambah Act Baru</h2>
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

            <form action="{{ route('admin.acts.store') }}" method="POST" class="admin-form">
                @csrf

                <div class="form-group">
                    <label for="chapter_id">Pilih Chapter <span class="required">*</span></label>
                    <select id="chapter_id" name="chapter_id" class="form-select @error('chapter_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Chapter --</option>
                        @foreach ($chapters as $chapter)
                            <option value="{{ $chapter->id }}" {{ old('chapter_id') == $chapter->id ? 'selected' : '' }}>
                                Era {{ $chapter->order_number }} - {{ $chapter->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('chapter_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Nama Act <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Contoh: Act 1 - Pengenalan" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Masukkan deskripsi act..." rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="order_number">Urutan <span class="required">*</span></label>
                    <input type="number" id="order_number" name="order_number" class="form-control @error('order_number') is-invalid @enderror"
                        placeholder="Contoh: 1" value="{{ old('order_number') }}" required>
                    <small class="form-text">Masukkan nomor urutan act</small>
                    @error('order_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.acts.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Act</button>
                </div>
            </form>
        </div>
    </div>
@endsection
