@extends('layouts.admin')

@section('page-title', 'Kelola Quiz Progress')

@section('title', 'Admin - Quiz Progress')

@section('content')
    <div class="page-actions mb-4">
        <div>
            <h2 class="section-title">Daftar Progress Quiz</h2>
            <hr class="section-underline">
        </div>
        <a href="{{ route('admin.progresses.create') }}" class="btn btn-success">Tambah Progress</a>
    </div>

    <div class="filter-panel">
        <form method="GET" action="{{ route('admin.progresses.index') }}" class="filter-form">
            <div class="filter-search">
                <input
                    type="text"
                    name="search"
                    class="admin-input"
                    placeholder="Cari user, email, atau quiz..."
                    value="{{ $search }}"
                >
            </div>

            <div class="filter-select">
                <select name="filter" class="admin-select">
                    <option value="">Semua Status</option>
                    <option value="passed" @if($filter === 'passed') selected @endif>Lulus</option>
                    <option value="failed" @if($filter === 'failed') selected @endif>Tidak Lulus</option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Riwayat Progress</h2>
        </div>
        <div class="card-body">
            @if($progresses->count() > 0)
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Judul Quiz</th>
                                <th class="text-center">Score</th>
                                <th class="text-center">Status</th>
                                <th>Tanggal Selesai</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($progresses as $index => $progress)
                                <tr>
                                    <td>{{ ($progresses->currentPage() - 1) * $progresses->perPage() + $index + 1 }}</td>
                                    <td class="cell-title">{{ $progress->user->nickname }}</td>
                                    <td class="cell-muted">{{ $progress->user->email }}</td>
                                    <td>{{ $progress->quiz->title }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ $progress->score }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($progress->passed)
                                            <span class="badge badge-success">Lulus</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Lulus</span>
                                        @endif
                                    </td>
                                    <td>{{ $progress->completed_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('admin.progresses.show', $progress->id) }}" class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('admin.progresses.edit', $progress->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                            <form action="{{ route('admin.progresses.destroy', $progress->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Yakin ingin menghapus?')">
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

                <div class="pagination-wrap">
                    {{ $progresses->links() }}
                </div>
            @else
                <div class="empty-state">
                    <p>Tidak ada data progress quiz.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
