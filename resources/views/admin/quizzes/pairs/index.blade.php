@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="section-title">
        <i class="bi bi-bullseye"></i> Pair Soal Quiz
        <hr class="section-underline">
    </h4>
    <a href="{{ route('admin.quizzes.pairs.create', $quiz) }}" class="btn btn-success">
        <i class="bi bi-plus"></i> Tambah Pair
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kiri</th>
                        <th>Kanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pairs as $i => $pair)
                        <tr>
                            <td>{{ $pairs->firstItem() + $i }}</td>
                            <td>{{ $pair->left_text }}</td>
                            <td>{{ $pair->right_text }}</td>
                            <td>
                                <a href="{{ route('admin.quizzes.pairs.edit', [$quiz, $pair]) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <form action="{{ route('admin.quizzes.pairs.destroy', [$quiz, $pair]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pair ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $pairs->links() }}
    </div>
</div>
@endsection
