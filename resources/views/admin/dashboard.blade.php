@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">📊 Selamat Datang di Admin Panel</h2>
        </div>
        <div style="padding: 20px; line-height: 1.8;">
            <p>Halo <strong>{{ auth()->user()->nickname }}</strong>, selamat datang di dashboard admin Deenia!</p>
            <p style="margin-top: 10px;">Gunakan menu di sidebar untuk mengelola konten aplikasi Anda.</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <!-- Stats Card -->
        <div class="card" style="text-align: center;">
            <div style="font-size: 32px; margin-bottom: 10px;">👥</div>
            <h3 style="color: #667eea; font-size: 24px;">{{ \App\Models\User::count() }}</h3>
            <p style="color: #666;">Total Users</p>
        </div>

        <div class="card" style="text-align: center;">
            <div style="font-size: 32px; margin-bottom: 10px;">📚</div>
            <h3 style="color: #667eea; font-size: 24px;">{{ \App\Models\Chapter::count() }}</h3>
            <p style="color: #666;">Total Chapters</p>
        </div>

        <div class="card" style="text-align: center;">
            <div style="font-size: 32px; margin-bottom: 10px;">🎭</div>
            <h3 style="color: #667eea; font-size: 24px;">0</h3>
            <p style="color: #666;">Total Acts</p>
        </div>

        <div class="card" style="text-align: center;">
            <div style="font-size: 32px; margin-bottom: 10px;">📖</div>
            <h3 style="color: #667eea; font-size: 24px;">0</h3>
            <p style="color: #666;">Total Lessons</p>
        </div>
    </div>

    <div class="card" style="margin-top: 30px;">
        <div class="card-header">
            <h3 class="card-title">🔗 Menu Cepat</h3>
        </div>
        <div style="padding: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 10px;">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Kelola Users</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Tambah User</a>
        </div>
    </div>
@endsection
