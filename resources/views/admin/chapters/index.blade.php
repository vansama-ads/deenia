@extends('layouts.admin')

@section('page-title', 'Kelola Chapters')

@section('title', 'Admin - Chapters')

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">📚 Daftar Chapters</h2>
                <a href="{{ route('admin.chapters.create') }}" class="btn btn-success">+ Tambah Chapter</a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div style="margin: 15px; padding: 12px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; color: #155724;">
                {{ $message }}
                <button type="button" style="float: right; background: none; border: none; cursor: pointer; font-size: 20px;" onclick="this.parentElement.style.display='none';">×</button>
            </div>
        @endif

        @if ($errors->any())
            <div style="margin: 15px; padding: 12px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; color: #721c24;">
                <strong>Error:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($chapters->count() > 0)
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #ddd;">
                        <th style="padding: 12px; text-align: left;">No</th>
                        <th style="padding: 12px; text-align: left;">Nama Chapter</th>
                        <th style="padding: 12px; text-align: left;">Deskripsi</th>
                        <th style="padding: 12px; text-align: left;">Urutan</th>
                        <th style="padding: 12px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chapters as $index => $chapter)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px;">{{ $index + 1 }}</td>
                            <td style="padding: 12px; font-weight: 500;">{{ $chapter->name }}</td>
                            <td style="padding: 12px; font-size: 13px; color: #555;">{{ Str::limit($chapter->description, 60, '...') }}</td>
                            <td style="padding: 12px;">
                                <span style="background: #667eea; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $chapter->order_number }}</span>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="{{ route('admin.chapters.edit', $chapter->id) }}" class="btn btn-secondary" style="padding: 6px 10px; font-size: 12px;">Edit</a>
                                <form action="{{ route('admin.chapters.destroy', $chapter->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                <p>Tidak ada data chapters</p>
            </div>
        @endif
    </div>
@endsection
