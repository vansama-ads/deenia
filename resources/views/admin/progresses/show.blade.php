@extends('layouts.admin')

@section('page-title', 'Detail Progress Quiz')

@section('title', 'Admin - Detail Progress Quiz')

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">📋 Detail Progress Quiz</h2>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('admin.progresses.edit', $progress->id) }}" class="btn btn-primary">✎ Edit</a>
                    <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">← Kembali</a>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 20px;">
            <!-- User Information -->
            <div>
                <h3 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #667eea; padding-bottom: 10px;">👤 Informasi User</h3>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 5px;">Nama User:</label>
                    <div style="background: #f8f9fa; padding: 12px; border-radius: 4px; border-left: 4px solid #667eea;">
                        {{ $progress->user->nickname }}
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 5px;">Email:</label>
                    <div style="background: #f8f9fa; padding: 12px; border-radius: 4px; border-left: 4px solid #667eea;">
                        {{ $progress->user->email }}
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 5px;">Gender:</label>
                    <div style="background: #f8f9fa; padding: 12px; border-radius: 4px; border-left: 4px solid #667eea;">
                        {{ ucfirst($progress->user->gender ?? '-') }}
                    </div>
                </div>
            </div>

            <!-- Quiz Information -->
            <div>
                <h3 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #667eea; padding-bottom: 10px;">🎯 Informasi Quiz</h3>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 5px;">Judul Quiz:</label>
                    <div style="background: #f8f9fa; padding: 12px; border-radius: 4px; border-left: 4px solid #667eea;">
                        {{ $progress->quiz->title }}
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 5px;">Jumlah Soal:</label>
                    <div style="background: #f8f9fa; padding: 12px; border-radius: 4px; border-left: 4px solid #667eea;">
                        {{ $progress->quiz->pairs->count() }} soal
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Information -->
        <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 5px;">
            <h3 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #667eea; padding-bottom: 10px;">📊 Hasil Progress</h3>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 20px;">
                <!-- Score -->
                <div style="background: white; padding: 15px; border-radius: 5px; text-align: center; border-top: 4px solid #667eea;">
                    <div style="font-size: 32px; font-weight: 700; color: #667eea;">{{ $progress->score }}</div>
                    <div style="color: #666; font-size: 12px;">Score (dari 100)</div>
                </div>

                <!-- Status -->
                <div style="background: white; padding: 15px; border-radius: 5px; text-align: center; border-top: 4px solid @if($progress->passed) #28a745 @else #dc3545 @endif;">
                    <div style="font-size: 20px; font-weight: 700; color: @if($progress->passed) #28a745 @else #dc3545 @endif;">
                        @if($progress->passed)
                            ✓ LULUS
                        @else
                            ✗ TIDAK LULUS
                        @endif
                    </div>
                    <div style="color: #666; font-size: 12px;">Status Kelulusan</div>
                </div>

                <!-- Tanggal Selesai -->
                <div style="background: white; padding: 15px; border-radius: 5px; text-align: center; border-top: 4px solid #17a2b8;">
                    <div style="font-size: 14px; font-weight: 700; color: #17a2b8;">{{ $progress->completed_at->format('d M Y') }}</div>
                    <div style="color: #666; font-size: 12px;">Tanggal Selesai</div>
                </div>

                <!-- Waktu -->
                <div style="background: white; padding: 15px; border-radius: 5px; text-align: center; border-top: 4px solid #ffc107;">
                    <div style="font-size: 14px; font-weight: 700; color: #ffc107;">{{ $progress->completed_at->format('H:i') }}</div>
                    <div style="color: #666; font-size: 12px;">Waktu Selesai</div>
                </div>
            </div>
        </div>

        <!-- Rule Kelulusan -->
        <div style="margin-top: 20px; padding: 15px; background: #d1ecf1; border-left: 4px solid #17a2b8; border-radius: 4px;">
            <p style="color: #0c5460; margin: 0; font-size: 13px;">
                <strong>ℹ️ Rule Kelulusan:</strong> Score ≥ 70 = Lulus | Score < 70 = Tidak Lulus
            </p>
        </div>
    </div>
@endsection
