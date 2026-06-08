@extends('layouts.admin')

@section('page-title', 'Edit Progress Quiz')

@section('title', 'Admin - Edit Progress Quiz')

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">✎ Edit Progress Quiz</h2>
                <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.progresses.update', $progress->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="max-width: 600px;">
                <!-- User Info (Read-only) -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">👤 User</label>
                    <div style="background: #f8f9fa; padding: 10px 12px; border-radius: 4px; border: 1px solid #ddd;">
                        <strong>{{ $progress->user->nickname }}</strong> ({{ $progress->user->email }})
                    </div>
                </div>

                <!-- Quiz Info (Read-only) -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">🎯 Quiz</label>
                    <div style="background: #f8f9fa; padding: 10px 12px; border-radius: 4px; border: 1px solid #ddd;">
                        <strong>{{ $progress->quiz->title }}</strong>
                    </div>
                </div>

                <!-- Score -->
                <div style="margin-bottom: 20px;">
                    <label for="score" style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">📊 Score (0-100)</label>
                    <input type="number" name="score" id="score" min="0" max="100" required 
                           value="{{ old('score', $progress->score) }}"
                           style="width: 100%; padding: 10px 12px; border: 1px solid @if($errors->has('score')) #dc3545 @else #ddd @endif; border-radius: 4px; font-size: 14px;">
                    @if($errors->has('score'))
                        <small style="color: #dc3545; display: block; margin-top: 5px;">{{ $errors->first('score') }}</small>
                    @endif
                </div>

                <!-- Passed Status -->
                <div style="margin-bottom: 20px;">
                    <label for="passed" style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">✓ Status Kelulusan</label>
                    <select name="passed" id="passed" required 
                            style="width: 100%; padding: 10px 12px; border: 1px solid @if($errors->has('passed')) #dc3545 @else #ddd @endif; border-radius: 4px; font-size: 14px;">
                        <option value="">-- Pilih Status --</option>
                        <option value="1" @if(old('passed', $progress->passed) == 1) selected @endif>✓ Lulus</option>
                        <option value="0" @if(old('passed', $progress->passed) == 0) selected @endif>✗ Tidak Lulus</option>
                    </select>
                    @if($errors->has('passed'))
                        <small style="color: #dc3545; display: block; margin-top: 5px;">{{ $errors->first('passed') }}</small>
                    @endif
                </div>

                <!-- Completed At -->
                <div style="margin-bottom: 20px;">
                    <label for="completed_at" style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">📅 Tanggal Selesai</label>
                    <input type="datetime-local" name="completed_at" id="completed_at" required 
                           value="{{ old('completed_at', $progress->completed_at->format('Y-m-d\TH:i')) }}"
                           style="width: 100%; padding: 10px 12px; border: 1px solid @if($errors->has('completed_at')) #dc3545 @else #ddd @endif; border-radius: 4px; font-size: 14px;">
                    @if($errors->has('completed_at'))
                        <small style="color: #dc3545; display: block; margin-top: 5px;">{{ $errors->first('completed_at') }}</small>
                    @endif
                </div>

                <!-- Info -->
                <div style="padding: 15px; background: #ffeeba; border-left: 4px solid #ffc107; border-radius: 4px; margin-bottom: 20px;">
                    <p style="color: #856404; margin: 0; font-size: 13px;">
                        <strong>ℹ️ Catatan:</strong> Anda dapat mengubah score, status kelulusan, dan tanggal selesai. Score ≥ 70 = Lulus, Score < 70 = Tidak Lulus.
                    </p>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-success" style="padding: 12px 24px;">💾 Update Progress</button>
                    <a href="{{ route('admin.progresses.show', $progress->id) }}" class="btn btn-secondary" style="padding: 12px 24px;">❌ Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
