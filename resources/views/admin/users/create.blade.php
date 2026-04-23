@extends('layouts.admin')

@section('page-title', 'Tambah User Baru')

@section('title', 'Admin - Tambah User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">➕ Tambah User Baru</h2>
        </div>

        <div style="padding: 20px;">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Nama Pengguna</label>
                    <input 
                        type="text" 
                        name="nickname" 
                        value="{{ old('nickname') }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                        required
                    >
                    @error('nickname')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                        required
                    >
                    @error('email')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Password</label>
                    <input 
                        type="password" 
                        name="password"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                        required
                    >
                    @error('password')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                        required
                    >
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Role</label>
                    <select 
                        name="role"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                    >
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-success">Simpan User</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
