@extends('layouts.admin')

@section('page-title', 'Kelola Lessons')

@section('title', 'Admin - Lessons')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <h2 class="card-title">Daftar Lessons</h2>
                <a href="{{ route('admin.lessons.create') }}" class="btn btn-success">Tambah Lesson</a>
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

            @if ($lessons->count() > 0)
                @foreach ($groupedLessons as $chapterId => $actGroups)
                    @php
                        $chapter = $actGroups->first()->first()->act->chapter;
                    @endphp

                    <section class="section-group">
                        <div class="section-banner">
                            <h3 class="section-banner-title">
                                Chapter {{ $chapter->order_number }} - {{ $chapter->name }}
                            </h3>
                        </div>

                        @foreach ($actGroups as $actId => $actLessons)
                            @php
                                $act = $actLessons->first()->act;
                            @endphp

                            <div class="subsection-banner">
                                <h4 class="subsection-title">{{ $act->name }}</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Lesson</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($actLessons as $index => $lesson)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td class="cell-title">{{ $lesson->title }}</td>
                                                <td>
                                                    <div class="table-actions">
                                                        <a href="{{ route('admin.lessons.show', $lesson->id) }}" class="btn btn-info btn-sm">View</a>
                                                        <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                                        <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        @endforeach
                    </section>
                @endforeach
            @else
                <div class="empty-state">
                    <p>Tidak ada data lessons</p>
                </div>
            @endif
        </div>
    </div>
@endsection
