@extends('layouts.admin')

@section('page-title', 'Kelola Acts')

@section('title', 'Admin - Acts')

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">🎭 Daftar Acts</h2>
                <a href="{{ route('admin.acts.create') }}" class="btn btn-success">+ Tambah Act</a>
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

        <!-- Loop melalui setiap Chapter -->
        @forelse ($chapters as $chapter)
            @if ($chapter->acts->count() > 0)
                <div style="margin-top: 30px; margin-bottom: 20px;">
                    <!-- Section Header untuk Chapter -->
                    <div style="background: #667eea; color: white; padding: 15px; border-radius: 4px; margin-bottom: 15px;">
                        <h3 style="margin: 0; font-size: 18px;">
                            Chapter {{ $chapter->order_number }} - {{ $chapter->name }}
                        </h3>
                        <small style="opacity: 0.9; margin-top: 5px; display: block;">{{ $chapter->acts->count() }} Act</small>
                    </div>

                    <!-- Tabel Acts untuk Chapter ini -->
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8f9fa; border-bottom: 2px solid #ddd;">
                                <th style="padding: 12px; text-align: left;">No</th>
                                <th style="padding: 12px; text-align: left;">Nama Act</th>
                                <th style="padding: 12px; text-align: left;">Deskripsi</th>
                                <th style="padding: 12px; text-align: center;">Urutan</th>
                                <th style="padding: 12px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chapter->acts as $index => $act)
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 12px;">{{ $index + 1 }}</td>
                                    <td style="padding: 12px; font-weight: 500;">{{ $act->name }}</td>
                                    <td style="padding: 12px; font-size: 13px; color: #555;">
                                        @if ($act->description)
                                            {{ Str::limit($act->description, 50, '...') }}
                                        @else
                                            <em style="color: #999;">Tidak ada deskripsi</em>
                                        @endif
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <span style="background: #667eea; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $act->order_number }}</span>
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <a href="{{ route('admin.acts.edit', $act->id) }}" class="btn btn-secondary" style="padding: 6px 10px; font-size: 12px;">Edit</a>
                                        <form action="{{ route('admin.acts.destroy', $act->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="padding: 6px 10px; font-size: 12px;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @empty
            <div style="padding: 40px; text-align: center; color: #666;">
                <p>Tidak ada data chapters</p>
            </div>
        @endforelse

        @if ($chapters->isEmpty())
            <div style="padding: 40px; text-align: center; color: #666;">
                <p>Tidak ada data acts</p>
            </div>
        @endif
    </div>
@endsection
