@extends('layouts.admin')

@section('page-title', 'Kelola Users')

@section('title', 'Admin - Users')

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">👥 Daftar Users</h2>
                <a href="{{ route('admin.users.create') }}" class="btn btn-success">+ Tambah User</a>
            </div>
        </div>

        @if($users->count() > 0)
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #ddd;">
                        <th style="padding: 12px; text-align: left;">No</th>
                        <th style="padding: 12px; text-align: left;">Avatar</th>
                        <th style="padding: 12px; text-align: left;">Nama</th>
                        <th style="padding: 12px; text-align: left;">Email</th>
                        <th style="padding: 12px; text-align: left;">Role</th>
                        <th style="padding: 12px; text-align: left;">Terdaftar</th>
                        <th style="padding: 12px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr style="border-bottom: 1px solid #eee; hover: {background: #f9f9f9;}">
                            <td style="padding: 12px;">{{ $index + 1 }}</td>
                            <td style="padding: 12px;">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #ddd; display: flex; align-items: center; justify-content: center; color: #666; font-size: 12px;">No Image</div>
                                @endif
                            </td>
                            <td style="padding: 12px; font-weight: 500;">{{ $user->nickname }}</td>
                            <td style="padding: 12px;">{{ $user->email }}</td>
                            <td style="padding: 12px;">
                                @if($user->role === 'admin')
                                    <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">Admin</span>
                                @else
                                    <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">User</span>
                                @endif
                            </td>
                            <td style="padding: 12px; font-size: 12px; color: #666;">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary" style="padding: 6px 10px; font-size: 12px;">View</a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary" style="padding: 6px 10px; font-size: 12px;">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 6px 10px; font-size: 12px;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="padding: 40px; text-align: center; color: #666;">
                <p>Tidak ada data users</p>
            </div>
        @endif
    </div>
@endsection
