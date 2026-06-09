@extends('layouts.admin')

@section('page-title', 'Lihat Detail User')

@section('title', 'Admin - Detail User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Detail User: {{ $user->nickname }}</h2>
        </div>

        <div class="admin-card-body">
            <div class="detail-grid">
                <div class="text-center">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar avatar-lg">
                    @else
                        <div class="avatar-placeholder avatar-lg">No Avatar</div>
                    @endif
                </div>

                <div class="detail-list">
                    <div class="detail-item">
                        <span class="detail-label">Nama Pengguna</span>
                        <p class="detail-value">{{ $user->nickname }}</p>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <p class="detail-value">{{ $user->email }}</p>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Role</span>
                        <p class="detail-value">
                            @if($user->role === 'admin')
                                <span class="badge badge-admin">Admin</span>
                            @else
                                <span class="badge badge-user">User</span>
                            @endif
                        </p>
                    </div>

                    @if($user->tanggal_lahir)
                        <div class="detail-item">
                            <span class="detail-label">Tanggal Lahir</span>
                            <p class="detail-value">{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') }}</p>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Umur</span>
                            <p class="detail-value detail-value-lg">
                                {{ \Carbon\Carbon::parse($user->tanggal_lahir)->age }} tahun
                            </p>
                        </div>
                    @endif

                    <div class="detail-item">
                        <span class="detail-label">Terdaftar Sejak</span>
                        <p class="detail-value">{{ $user->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">Edit User</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus User</button>
                </form>
            </div>
        </div>
    </div>
@endsection
