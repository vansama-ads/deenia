@extends('layouts.admin')

@section('page-title', 'Kelola Acts')

@section('title', 'Admin - Acts')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <h2 class="card-title">Daftar Acts</h2>
                <a href="{{ route('admin.acts.create') }}" class="btn btn-success">Tambah Act</a>
            </div>
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

            @forelse ($chapters as $chapter)
                @if ($chapter->acts->count() > 0)
                    <section class="section-group">
                        <div class="section-banner">
                            <h3 class="section-banner-title">
                                Chapter {{ $chapter->order_number }} - {{ $chapter->name }}
                            </h3>
                            <small class="section-kicker">{{ $chapter->acts->count() }} Act</small>
                        </div>

                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Act</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center">Urutan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chapter->acts as $index => $act)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="cell-title">{{ $act->name }}</td>
                                            <td class="cell-muted">
                                                @if ($act->description)
                                                    {{ Str::limit($act->description, 50, '...') }}
                                                @else
                                                    <em>Tidak ada deskripsi</em>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-order">{{ $act->order_number }}</span>
                                            </td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.acts.edit', $act->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                                    <form action="{{ route('admin.acts.destroy', $act->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    </section>
                @endif
            @empty
                <div class="empty-state">
                    <p>Tidak ada data chapters</p>
                </div>
            @endforelse

            @if ($chapters->isEmpty())
                <div class="empty-state">
                    <p>Tidak ada data acts</p>
                </div>
            @endif
        </div>
    </div>
@endsection
