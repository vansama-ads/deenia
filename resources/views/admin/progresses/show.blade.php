@extends('layouts.admin')

@section('page-title', 'Detail Progress Quiz')

@section('title', 'Admin - Detail Progress Quiz')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-toolbar">
                <h2 class="card-title">Detail Progress Quiz</h2>
                <div class="table-actions">
                    <a href="{{ route('admin.progresses.edit', $progress->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="detail-panel-grid">
                <section>
                    <h3 class="detail-section-title">Informasi User</h3>
                    <div class="detail-list">
                        <div class="detail-item">
                            <span class="detail-label">Nama User</span>
                            <p class="detail-value">{{ $progress->user->nickname }}</p>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email</span>
                            <p class="detail-value">{{ $progress->user->email }}</p>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Gender</span>
                            <p class="detail-value">{{ ucfirst($progress->user->gender ?? '-') }}</p>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="detail-section-title">Informasi Quiz</h3>
                    <div class="detail-list">
                        <div class="detail-item">
                            <span class="detail-label">Judul Quiz</span>
                            <p class="detail-value">{{ $progress->quiz->title }}</p>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Jumlah Soal</span>
                            <p class="detail-value">{{ $progress->quiz->pairs->count() }} soal</p>
                        </div>
                    </div>
                </section>
            </div>

            <section class="metric-panel">
                <h3 class="detail-section-title">Hasil Progress</h3>
                <div class="metric-grid">
                    <div class="metric-card">
                        <div class="metric-value">{{ $progress->score }}</div>
                        <div class="metric-label">Score dari 100</div>
                    </div>
                    <div class="metric-card @if(!$progress->passed) is-danger @endif">
                        <div class="metric-value">{{ $progress->passed ? 'Lulus' : 'Tidak Lulus' }}</div>
                        <div class="metric-label">Status Kelulusan</div>
                    </div>
                    <div class="metric-card is-muted">
                        <div class="metric-value">{{ $progress->completed_at->format('d M Y') }}</div>
                        <div class="metric-label">Tanggal Selesai</div>
                    </div>
                    <div class="metric-card is-muted">
                        <div class="metric-value">{{ $progress->completed_at->format('H:i') }}</div>
                        <div class="metric-label">Waktu Selesai</div>
                    </div>
                </div>
            </section>

            <div class="note">
                <strong>Rule Kelulusan:</strong> Score minimal 70 dinyatakan lulus.
            </div>
        </div>
    </div>
@endsection
