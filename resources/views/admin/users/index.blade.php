@extends('layouts.admin')

@section('page-title', 'Kelola Users')

@section('title', 'Admin - Users')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <h2 class="card-title">Daftar Users</h2>
                <a href="{{ route('admin.users.create') }}" class="btn btn-success">Tambah User</a>
            </div>
        </div>

        <div class="admin-card-body">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Avatar</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Terdaftar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar">
                                        @else
                                            <div class="avatar-placeholder">No Image</div>
                                        @endif
                                    </td>
                                    <td class="cell-title">{{ $user->nickname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role === 'admin')
                                            <span class="badge badge-admin">Admin</span>
                                        @else
                                            <span class="badge badge-user">User</span>
                                        @endif
                                    </td>
                                    <td class="cell-muted">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <p>Tidak ada data users</p>
                </div>
            @endif
        </div>
    </div>
@endsection
