@extends('layouts.admin')

@section('page-title', 'Edit User')

@section('title', 'Admin - Edit User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">✏️ Edit User: {{ $user->nickname }}</h2>
        </div>

        <div style="padding: 20px;">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Nama Pengguna</label>
                    <input 
                        type="text" 
                        name="nickname" 
                        value="{{ old('nickname', $user->nickname) }}"
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
                        value="{{ old('email', $user->email) }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                        required
                    >
                    @error('email')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Tanggal Lahir</label>
                    <input 
                        type="date" 
                        name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                    >
                    @error('tanggal_lahir')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Avatar</label>
                    @if($user->avatar)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 100px; height: 100px; border-radius: 5px; object-fit: cover;">
                        </div>
                    @endif
                    <input 
                        type="file" 
                        name="avatar"
                        accept="image/*"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                    >
                    <div style="color: #666; font-size: 12px; margin-top: 5px;">Format: JPG, PNG, GIF (Max 2MB) - Biarkan kosong jika tidak ingin mengubah</div>
                    @error('avatar')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Role</label>
                    <select 
                        name="role"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"
                    >
                        <option value="user" @if($user->role === 'user') selected @endif>User</option>
                        <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
