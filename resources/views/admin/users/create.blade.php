@extends('layouts.admin')

@section('page-title', 'Tambah User Baru')

@section('title', 'Admin - Tambah User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Tambah User Baru</h2>
        </div>

        <div class="admin-card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
                @csrf

                <div class="form-group">
                    <label for="nickname">Nama Pengguna</label>
                    <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}"
                        class="form-control @error('nickname') is-invalid @enderror" required>
                    @error('nickname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" id="avatar" name="avatar" accept="image/*"
                        class="form-control @error('avatar') is-invalid @enderror">
                    <div class="form-text">Format: JPG, PNG, GIF (Max 2MB)</div>
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" class="form-select">
                        <option value="user" @if(old('role') === 'user') selected @endif>User</option>
                        <option value="admin" @if(old('role') === 'admin') selected @endif>Admin</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan User</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
