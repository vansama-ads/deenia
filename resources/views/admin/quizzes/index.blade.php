@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="section-title">
        <i class="bi bi-bullseye"></i> Daftar Quizzes
        <hr class="section-underline">
    </h4>
    <a href="{{ route('admin.quizzes.create') }}" class="btn btn-success">
        <i class="bi bi-plus"></i> Tambah Quiz
    </a>
</div>

@forelse($quizzes as $chapterId => $actGroups)
    @php
        $chapter = $actGroups->first()->first()->act->chapter;
    @endphp
    
    <!-- CHAPTER HERO SECTION -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 8px; margin-bottom: 30px; margin-top: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
        <h2 style="margin: 0 0 8px 0; font-size: 28px; font-weight: 700;">
            <i class="bi bi-book"></i> Chapter {{ $chapter->order_number }} - {{ $chapter->name }}
        </h2>
        <p style="margin: 5px 0; opacity: 0.95; font-size: 14px;">{{ $actGroups->sum(fn($actQuizzes) => $actQuizzes->count()) }} Quiz</p>
    </div>

    <!-- ACTS AND QUIZZES INSIDE CHAPTER -->
    @foreach($actGroups as $actId => $quizzesInAct)
        @php
            $act = $quizzesInAct->first()->act;
        @endphp
        
        <!-- ACT SUBSECTION -->
        <div style="background: #f8f9fa; padding: 18px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #667eea;">
            <h4 style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">
                <i class="bi bi-bookmark"></i> Act {{ $act->order_number }} - {{ $act->name }}
            </h4>
            <small style="color: #666;">{{ $quizzesInAct->count() }} Quiz</small>
        </div>

        <!-- QUIZZES IN THIS ACT -->
        @foreach($quizzesInAct as $quiz)
            <div class="card mb-4" style="border-left: 5px solid #667eea; box-shadow: 0 2px 4px rgba(0,0,0,0.08); margin-bottom: 20px; margin-left: 20px;">
                <div class="card-header" style="background: #fff; padding: 16px; border-bottom: 1px solid #ddd;">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px;">
                        <h5 class="card-title mb-0" style="font-weight: 600; font-size: 16px;">
                            <i class="bi bi-question-circle" style="color: #667eea;"></i> {{ $quiz->title }}
                        </h5>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="{{ route('admin.quizzes.show', $quiz) }}" class="btn btn-info btn-sm" title="Lihat detail">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                            <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="btn btn-secondary btn-sm" title="Edit quiz">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('admin.quizzes.pairs.index', $quiz) }}" class="btn btn-primary btn-sm" title="Kelola pair">
                                <i class="bi bi-link"></i> Pair
                            </a>
                            <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus quiz ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus quiz">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 20px;">
                    <div class="table-responsive">
                        <table style="width: 100%; border-collapse: collapse;" class="table table-bordered align-middle">
                            <thead>
                                <tr style="background: #f8f9fa; border-bottom: 2px solid #ddd;">
                                    <th style="padding: 14px; text-align: left; width: 8%; font-weight: 600;">No</th>
                                    <th style="padding: 14px; text-align: left; width: 46%; font-weight: 600;">Kiri</th>
                                    <th style="padding: 14px; text-align: left; width: 46%; font-weight: 600;">Kanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quiz->pairs as $i => $pair)
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <td style="padding: 14px; text-align: center; color: #666;">{{ $i + 1 }}</td>
                                        <td style="padding: 14px; color: #333;">{{ Str::limit($pair->left_text, 80, '...') }}</td>
                                        <td style="padding: 14px; color: #333;">{{ Str::limit($pair->right_text, 80, '...') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" style="padding: 20px; text-align: center; color: #999;">
                                            <i class="bi bi-inbox" style="font-size: 18px; margin-right: 8px;"></i> Belum ada pair untuk quiz ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($quiz->pairs->count() > 0)
                        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee; text-align: right; font-size: 13px; color: #666; font-weight: 500;">
                            <i class="bi bi-list"></i> Total: <span style="color: #667eea; font-weight: 600;">{{ $quiz->pairs->count() }}</span> pair
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        
        <!-- Spacing antar act -->
        @if(!$loop->last)
            <div style="margin-bottom: 30px;"></div>
        @endif
    @endforeach
    
    <!-- Spacing antar chapter -->
    @if(!$loop->last)
        <div style="margin-bottom: 40px;"></div>
    @endif
@empty
    <div class="card">
        <div class="card-body">
            <div style="text-align: center; padding: 40px; color: #999;">
                <i class="bi bi-inbox" style="font-size: 48px; margin-bottom: 20px; display: block;"></i>
                <p>Belum ada quiz yang tersedia</p>
            </div>
        </div>
    </div>
@endforelse

@endsection