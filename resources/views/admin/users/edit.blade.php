@extends('layouts.admin')

@section('page-title', 'Edit User')

@section('title', 'Admin - Edit User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Edit User: {{ $user->nickname }}</h2>
        </div>

        <div class="admin-card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="admin-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nickname">Nama Pengguna</label>
                    <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $user->nickname) }}"
                        class="form-control @error('nickname') is-invalid @enderror" required>
                    @error('nickname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar-preview">
                    @endif
                    <input type="file" id="avatar" name="avatar" accept="image/*"
                        class="form-control @error('avatar') is-invalid @enderror">
                    <div class="form-text">Format: JPG, PNG, GIF (Max 2MB) - Biarkan kosong jika tidak ingin mengubah</div>
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" class="form-select">
                        <option value="user" @if($user->role === 'user') selected @endif>User</option>
                        <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
