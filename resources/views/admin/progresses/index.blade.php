@extends('layouts.admin')

@section('page-title', 'Kelola Quiz Progress')

@section('title', 'Admin - Quiz Progress')

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">📊 Daftar Progress Quiz</h2>
                <a href="{{ route('admin.progresses.create') }}" class="btn btn-success">+ Tambah Progress</a>
            </div>
        </div>

        <!-- Search dan Filter -->
        <div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 5px;">
            <form method="GET" action="{{ route('admin.progresses.index') }}" style="display: flex; gap: 15px; flex-wrap: wrap;">
                <!-- Search -->
                <div style="flex: 1; min-width: 250px;">
                    <input type="text" name="search" placeholder="Cari user (nickname/email) atau quiz..." 
                           value="{{ $search }}" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <!-- Filter -->
                <div>
                    <select name="filter" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">Semua Status</option>
                        <option value="passed" @if($filter === 'passed') selected @endif>✓ Lulus</option>
                        <option value="failed" @if($filter === 'failed') selected @endif>✗ Tidak Lulus</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary">🔍 Cari</button>
                    <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">↻ Reset</a>
                </div>
            </form>
        </div>

        <!-- Table -->
        @if($progresses->count() > 0)
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #ddd;">
                        <th style="padding: 12px; text-align: left;">No</th>
                        <th style="padding: 12px; text-align: left;">Nama User</th>
                        <th style="padding: 12px; text-align: left;">Email</th>
                        <th style="padding: 12px; text-align: left;">Judul Quiz</th>
                        <th style="padding: 12px; text-align: center;">Score</th>
                        <th style="padding: 12px; text-align: center;">Status</th>
                        <th style="padding: 12px; text-align: left;">Tanggal Selesai</th>
                        <th style="padding: 12px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($progresses as $index => $progress)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px;">{{ ($progresses->currentPage() - 1) * 15 + $index + 1 }}</td>
                            <td style="padding: 12px; font-weight: 500;">{{ $progress->user->nickname }}</td>
                            <td style="padding: 12px; font-size: 13px;">{{ $progress->user->email }}</td>
                            <td style="padding: 12px;">{{ $progress->quiz->title }}</td>
                            <td style="padding: 12px; text-align: center; font-weight: 600; color: #667eea;">{{ $progress->score }}</td>
                            <td style="padding: 12px; text-align: center;">
                                @if($progress->passed)
                                    <span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">✓ Lulus</span>
                                @else
                                    <span style="background: #f8d7da; color: #721c24; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">✗ Tidak Lulus</span>
                                @endif
                            </td>
                            <td style="padding: 12px; font-size: 13px;">{{ $progress->completed_at->format('d M Y H:i') }}</td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.progresses.show', $progress->id) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">👁️ Detail</a>
                                    <a href="{{ route('admin.progresses.edit', $progress->id) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">✎ Edit</a>
                                    <form action="{{ route('admin.progresses.destroy', $progress->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div style="margin-top: 20px; display: flex; justify-content: center;">
                {{ $progresses->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 40px; color: #999;">
                <p style="font-size: 16px;">📭 Tidak ada data progress quiz</p>
            </div>
        @endif
    </div>
@endsection
