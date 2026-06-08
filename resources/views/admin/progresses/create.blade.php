@extends('layouts.admin')

@section('page-title', 'Tambah Progress Quiz')

@section('title', 'Admin - Tambah Progress Quiz')

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">➕ Tambah Progress Quiz Baru</h2>
                <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.progresses.store') }}" method="POST">
            @csrf

            <div style="max-width: 600px;">
                <!-- User -->
                <div style="margin-bottom: 20px;">
                    <label for="user_id" style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">👤 Pilih User</label>
                    <select name="user_id" id="user_id" required 
                            style="width: 100%; padding: 10px 12px; border: 1px solid @if($errors->has('user_id')) #dc3545 @else #ddd @endif; border-radius: 4px; font-size: 14px;">
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>
                                {{ $user->nickname }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('user_id'))
                        <small style="color: #dc3545; display: block; margin-top: 5px;">{{ $errors->first('user_id') }}</small>
                    @endif
                </div>

                <!-- Quiz -->
                <div style="margin-bottom: 20px;">
                    <label for="quiz_id" style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">🎯 Pilih Quiz</label>
                    <select name="quiz_id" id="quiz_id" required 
                            style="width: 100%; padding: 10px 12px; border: 1px solid @if($errors->has('quiz_id')) #dc3545 @else #ddd @endif; border-radius: 4px; font-size: 14px;">
                        <option value="">-- Pilih Quiz --</option>
                        @foreach($quizzes as $quiz)
                            <option value="{{ $quiz->id }}" @if(old('quiz_id') == $quiz->id) selected @endif>
                                {{ $quiz->title }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('quiz_id'))
                        <small style="color: #dc3545; display: block; margin-top: 5px;">{{ $errors->first('quiz_id') }}</small>
                    @endif
                </div>

                <!-- Score -->
                <div style="margin-bottom: 20px;">
                    <label for="score" style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">📊 Score (0-100)</label>
                    <input type="number" name="score" id="score" min="0" max="100" required placeholder="Masukkan score"
                           value="{{ old('score') }}"
                           style="width: 100%; padding: 10px 12px; border: 1px solid @if($errors->has('score')) #dc3545 @else #ddd @endif; border-radius: 4px; font-size: 14px;">
                    @if($errors->has('score'))
                        <small style="color: #dc3545; display: block; margin-top: 5px;">{{ $errors->first('score') }}</small>
                    @endif
                </div>

                <!-- Completed At -->
                <div style="margin-bottom: 20px;">
                    <label for="completed_at" style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">📅 Tanggal Selesai</label>
                    <input type="datetime-local" name="completed_at" id="completed_at" required 
                           value="{{ old('completed_at') }}"
                           style="width: 100%; padding: 10px 12px; border: 1px solid @if($errors->has('completed_at')) #dc3545 @else #ddd @endif; border-radius: 4px; font-size: 14px;">
                    @if($errors->has('completed_at'))
                        <small style="color: #dc3545; display: block; margin-top: 5px;">{{ $errors->first('completed_at') }}</small>
                    @endif
                </div>

                <!-- Info -->
                <div style="padding: 15px; background: #d1ecf1; border-left: 4px solid #17a2b8; border-radius: 4px; margin-bottom: 20px;">
                    <p style="color: #0c5460; margin: 0; font-size: 13px;">
                        <strong>ℹ️ Informasi:</strong> Status kelulusan akan otomatis ditentukan berdasarkan score. Score ≥ 70 = Lulus, Score < 70 = Tidak Lulus
                    </p>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-success" style="padding: 12px 24px;">💾 Simpan Progress</button>
                    <a href="{{ route('admin.progresses.index') }}" class="btn btn-secondary" style="padding: 12px 24px;">❌ Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
