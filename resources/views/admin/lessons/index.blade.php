@extends('layouts.admin')

@section('page-title', 'Kelola Lessons')

@section('title', 'Admin - Lessons')

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">📖 Daftar Lessons</h2>
                <a href="{{ route('admin.lessons.create') }}" class="btn btn-success">+ Tambah Lesson</a>
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

        @if ($lessons->count() > 0)
            <!-- Loop melalui setiap Chapter -->
            @foreach ($groupedLessons as $chapterId => $actGroups)
                <!-- Ambil chapter dari act pertama -->
                @php
                    $chapter = $actGroups->first()->first()->act->chapter;
                @endphp

                <div style="margin-top: 30px; margin-bottom: 20px;">
                    <!-- Section Header untuk Chapter -->
                    <div style="background: #667eea; color: white; padding: 15px; border-radius: 4px; margin-bottom: 15px;">
                        <h3 style="margin: 0; font-size: 18px;">
                            Chapter {{ $chapter->order_number }} - {{ $chapter->name }}
                        </h3>
                    </div>

                    <!-- Loop melalui setiap Act dalam Chapter -->
                    @foreach ($actGroups as $actId => $actLessons)
                        @php
                            $act = $actLessons->first()->act;
                        @endphp

                        <div style="background: #f5f6fa; padding: 12px 15px; margin-bottom: 10px; border-left: 4px solid #667eea; border-radius: 3px;">
                            <h4 style="margin: 0; font-size: 15px; color: #333;">
                                🎭 {{ $act->name }}
                            </h4>
                        </div>

                        <!-- Tabel Lessons untuk Act ini -->
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
                            <thead>
                                <tr style="background: #f8f9fa; border-bottom: 2px solid #ddd;">
                                    <th style="padding: 12px; text-align: left;">No</th>
                                    <th style="padding: 12px; text-align: left;">Judul Lesson</th>
                                    <th style="padding: 12px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actLessons as $index => $lesson)
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <td style="padding: 12px;">{{ $index + 1 }}</td>
                                        <td style="padding: 12px;">{{ $lesson->title }}</td>
                                        <td style="padding: 12px; text-align: center;">
                                            <a href="{{ route('admin.lessons.show', $lesson->id) }}" class="btn btn-info" style="padding: 6px 12px; font-size: 12px; background: #17a2b8; color: white; text-decoration: none; border: none; border-radius: 3px; cursor: pointer; display: inline-block; margin-right: 5px;">👁️ View</a>
                                            <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px; margin-right: 5px; background: #6c757d; color: white; text-decoration: none; border: none; border-radius: 3px; cursor: pointer; display: inline-block;">✏️ Edit</a>
                                            <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px; background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer;">🗑️ Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            @endforeach
        @else
            <div style="padding: 40px; text-align: center; color: #666;">
                <p>Tidak ada data lessons</p>
            </div>
        @endif
    </div>
@endsection
