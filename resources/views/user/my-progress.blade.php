@extends('layouts.app')

@section('content')
<div style="padding: 20px 0;">
    <div style="max-width: 1000px; margin: 0 auto; padding: 0 20px;">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px; border-radius: 10px; color: white; margin-bottom: 30px;">
            <h1 style="font-size: 28px; margin: 0; margin-bottom: 10px;">📊 Progress Saya</h1>
            <p style="margin: 0; font-size: 14px; opacity: 0.9;">Lihat semua quiz yang telah Anda kerjakan beserta nilai dan statusnya</p>
        </div>

        <!-- Stats -->
        @if($progresses->total() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <!-- Total Quizzes -->
                <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-top: 4px solid #667eea;">
                    <div style="font-size: 24px; font-weight: 700; color: #667eea;">{{ $progresses->total() }}</div>
                    <div style="font-size: 12px; color: #999;">Total Quiz Dikerjakan</div>
                </div>

                <!-- Passed -->
                @php
                    $passed = $progresses->getCollection()->where('passed', true)->count();
                @endphp
                <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-top: 4px solid #28a745;">
                    <div style="font-size: 24px; font-weight: 700; color: #28a745;">{{ $passed }}</div>
                    <div style="font-size: 12px; color: #999;">✓ Quiz Lulus</div>
                </div>

                <!-- Not Passed -->
                @php
                    $failed = $progresses->getCollection()->where('passed', false)->count();
                @endphp
                <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-top: 4px solid #dc3545;">
                    <div style="font-size: 24px; font-weight: 700; color: #dc3545;">{{ $failed }}</div>
                    <div style="font-size: 12px; color: #999;">✗ Quiz Belum Lulus</div>
                </div>

                <!-- Average Score -->
                @php
                    $avgScore = $progresses->getCollection()->avg('score');
                @endphp
                <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-top: 4px solid #ffc107;">
                    <div style="font-size: 24px; font-weight: 700; color: #ffc107;">{{ round($avgScore, 1) }}</div>
                    <div style="font-size: 12px; color: #999;">Rata-rata Score</div>
                </div>
            </div>
        @endif

        <!-- Progress List -->
        <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
            <div style="padding: 20px; border-bottom: 2px solid #f0f0f0;">
                <h2 style="margin: 0; font-size: 18px; color: #333;">📋 Daftar Quiz</h2>
            </div>

            @if($progresses->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8f9fa; border-bottom: 1px solid #e0e0e0;">
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #666;">No</th>
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #666;">Judul Quiz</th>
                                <th style="padding: 15px; text-align: center; font-weight: 600; color: #666;">Nilai</th>
                                <th style="padding: 15px; text-align: center; font-weight: 600; color: #666;">Status</th>
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #666;">Tanggal Penyelesaian</th>
                                <th style="padding: 15px; text-align: center; font-weight: 600; color: #666;">Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($progresses as $index => $progress)
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;">
                                    <td style="padding: 15px; color: #666;">{{ ($progresses->currentPage() - 1) * 10 + $index + 1 }}</td>
                                    <td style="padding: 15px; color: #333; font-weight: 500;">{{ $progress->quiz->title }}</td>
                                    <td style="padding: 15px; text-align: center;">
                                        <span style="font-size: 18px; font-weight: 700; color: #667eea;">{{ $progress->score }}</span>
                                    </td>
                                    <td style="padding: 15px; text-align: center;">
                                        @if($progress->passed)
                                            <span style="background: #d4edda; color: #155724; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600;">✓ Lulus</span>
                                        @else
                                            <span style="background: #f8d7da; color: #721c24; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600;">✗ Tidak Lulus</span>
                                        @endif
                                    </td>
                                    <td style="padding: 15px; color: #999; font-size: 13px;">{{ $progress->completed_at->format('d M Y H:i') }}</td>
                                    <td style="padding: 15px; text-align: center;">
                                        <!-- Progress Bar -->
                                        <div style="background: #f0f0f0; height: 6px; border-radius: 3px; width: 60px; margin: 0 auto; overflow: hidden;">
                                            <div style="background: @if($progress->score >= 70) #28a745 @else #dc3545 @endif; height: 100%; width: {{ $progress->score }}%; transition: width 0.3s;"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div style="padding: 20px; border-top: 1px solid #f0f0f0; display: flex; justify-content: center;">
                    {{ $progresses->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px; color: #999;">
                    <div style="font-size: 48px; margin-bottom: 10px;">📭</div>
                    <p style="font-size: 16px; margin: 0;">Anda belum mengerjakan quiz apapun</p>
                    <p style="font-size: 13px; margin: 10px 0 0 0;">Mulai kerjakan quiz untuk melihat progress Anda di sini</p>
                </div>
            @endif
        </div>

        <!-- Info Box -->
        <div style="margin-top: 30px; padding: 20px; background: #e7f3ff; border-left: 4px solid #2196F3; border-radius: 4px;">
            <p style="margin: 0; color: #1565c0; font-size: 13px;">
                <strong>ℹ️ Informasi:</strong> Halaman ini menampilkan semua quiz yang telah Anda kerjakan. Nilai yang ditampilkan adalah nilai final Anda pada quiz tersebut. Anda dapat mengerjakan ulang quiz dengan hasil terbaru akan menggantikan hasil sebelumnya.
            </p>
        </div>
    </div>
</div>
@endsection
