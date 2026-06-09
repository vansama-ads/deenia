@extends('layouts.admin')

@section('page-title', 'Edit Chapter')

@section('title', 'Edit Chapter')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Edit Chapter</h2>
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

            <form action="{{ route('admin.chapters.update', $chapter->id) }}" method="POST" class="admin-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Chapter <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Contoh: Chapter 1 - Pengenalan" value="{{ old('name', $chapter->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi <span class="required">*</span></label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Masukkan deskripsi chapter..." rows="6" required>{{ old('description', $chapter->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="order_number">Urutan <span class="required">*</span></label>
                    <input type="number" id="order_number" name="order_number" class="form-control @error('order_number') is-invalid @enderror"
                        placeholder="Contoh: 1" value="{{ old('order_number', $chapter->order_number) }}" required>
                    <small class="form-text">Masukkan nomor urutan chapter (harus unik)</small>
                    @error('order_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.chapters.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Chapter</button>
                </div>
            </form>
        </div>
    </div>
@endsection
