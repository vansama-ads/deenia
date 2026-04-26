@extends('layouts.admin')

@section('page-title', 'Lihat Detail User')

@section('title', 'Admin - Detail User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">👤 Detail User: {{ $user->nickname }}</h2>
        </div>

        <div style="padding: 20px;">
            <div style="display: grid; grid-template-columns: auto 1fr; gap: 30px;">
                <!-- Avatar Section -->
                <div style="text-align: center;">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    @else
                        <div style="width: 150px; height: 150px; border-radius: 50%; background: #ddd; display: flex; align-items: center; justify-content: center; color: #666;">
                            <span style="font-size: 14px;">No Avatar</span>
                        </div>
                    @endif
                </div>

                <!-- Info Section -->
                <div>
                    <div style="margin-bottom: 20px;">
                        <label style="color: #666; font-size: 12px; text-transform: uppercase;">Nama Pengguna</label>
                        <p style="font-size: 16px; font-weight: 600; color: #333; margin-top: 5px;">{{ $user->nickname }}</p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="color: #666; font-size: 12px; text-transform: uppercase;">Email</label>
                        <p style="font-size: 14px; color: #333; margin-top: 5px;">{{ $user->email }}</p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="color: #666; font-size: 12px; text-transform: uppercase;">Role</label>
                        <p style="margin-top: 5px;">
                            @if($user->role === 'admin')
                                <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">Admin</span>
                            @else
                                <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">User</span>
                            @endif
                        </p>
                    </div>

                    @if($user->tanggal_lahir)
                        <div style="margin-bottom: 20px;">
                            <label style="color: #666; font-size: 12px; text-transform: uppercase;">Tanggal Lahir</label>
                            <p style="font-size: 14px; color: #333; margin-top: 5px;">{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') }}</p>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label style="color: #666; font-size: 12px; text-transform: uppercase;">Umur</label>
                            <p style="font-size: 20px; font-weight: 600; color: #667eea; margin-top: 5px;">
                                {{ \Carbon\Carbon::parse($user->tanggal_lahir)->age }} tahun
                            </p>
                        </div>
                    @endif

                    <div style="margin-bottom: 20px;">
                        <label style="color: #666; font-size: 12px; text-transform: uppercase;">Terdaftar Sejak</label>
                        <p style="font-size: 14px; color: #333; margin-top: 5px;">{{ $user->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary">Edit User</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Kembali</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus User</button>
                </form>
            </div>
        </div>
    </div>
@endsection
