@extends('layouts.admin')

@section('page-title', 'Kelola Chapters')

@section('title', 'Admin - Chapters')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <h2 class="card-title">Daftar Chapters</h2>
                <a href="{{ route('admin.chapters.create') }}" class="btn btn-success">Tambah Chapter</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="admin-card-body">
                <div class="alert alert-danger">
                    <strong>Error:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="admin-card-body">
            @if($chapters->count() > 0)
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Chapter</th>
                                <th>Deskripsi</th>
                                <th>Urutan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chapters as $index => $chapter)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="cell-title">{{ $chapter->name }}</td>
                                    <td class="cell-muted">{{ Str::limit($chapter->description, 60, '...') }}</td>
                                    <td>
                                        <span class="badge badge-order">{{ $chapter->order_number }}</span>
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('admin.chapters.edit', $chapter->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                            <form action="{{ route('admin.chapters.destroy', $chapter->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    <p>Tidak ada data chapters</p>
                </div>
            @endif
        </div>
    </div>
@endsection
