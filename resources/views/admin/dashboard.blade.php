@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Selamat Datang di Admin Panel</h2>
        </div>
        <div class="admin-card-body admin-copy">
            <p>Halo <strong>{{ auth()->user()->nickname }}</strong>, selamat datang di dashboard admin Deenia!</p>
            <p>Gunakan menu di sidebar untuk mengelola konten aplikasi Anda.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="card stat-card">
            <div class="stat-icon">U</div>
            <h3 class="stat-value">{{ $totalUsers }}</h3>
            <p class="stat-label">Total Users</p>
        </div>

        <div class="card stat-card">
            <div class="stat-icon">C</div>
            <h3 class="stat-value">{{ $totalChapters }}</h3>
            <p class="stat-label">Total Chapters</p>
        </div>

        <div class="card stat-card">
            <div class="stat-icon">A</div>
            <h3 class="stat-value">{{ $totalActs }}</h3>
            <p class="stat-label">Total Acts</p>
        </div>

        <div class="card stat-card">
            <div class="stat-icon">L</div>
            <h3 class="stat-value">{{ $totalLessons }}</h3>
            <p class="stat-label">Total Lessons</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Menu Cepat</h3>
        </div>
        <div class="admin-card-body quick-actions">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Kelola Users</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Tambah User</a>
        </div>
    </div>
@endsection
