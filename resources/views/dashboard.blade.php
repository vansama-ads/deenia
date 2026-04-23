@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="color: #333; margin-bottom: 15px; font-size: 28px;">👋 Halo, {{ auth()->user()->nickname }}!</h1>
        <p style="color: #666; line-height: 1.6; font-size: 16px; margin-bottom: 10px;">Selamat datang di dashboard Deenia. Anda telah berhasil login ke akun Anda.</p>
        <p style="color: #666; line-height: 1.6; font-size: 16px;">Silakan kelola profil dan data Anda dari halaman ini.</p>
    </div>

    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); margin-top: 20px;">
        <h2 style="color: #333; margin-bottom: 20px; font-size: 20px; border-bottom: 2px solid #667eea; padding-bottom: 10px;">Informasi Akun</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; display: block; margin-bottom: 5px;">Nama Pengguna</label>
                <p style="color: #333; font-weight: 600; font-size: 16px;">{{ auth()->user()->nickname }}</p>
            </div>

            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; display: block; margin-bottom: 5px;">Email</label>
                <p style="color: #333; font-weight: 600; font-size: 16px;">{{ auth()->user()->email }}</p>
            </div>

            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; display: block; margin-bottom: 5px;">Role</label>
                <p style="margin-top: 0;">
                    @if(auth()->user()->role === 'admin')
                        <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 4px;">Admin</span>
                    @else
                        <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 4px;">User</span>
                    @endif
                </p>
            </div>

            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; display: block; margin-bottom: 5px;">Terdaftar Sejak</label>
                <p style="color: #333; font-weight: 600; font-size: 16px;">{{ auth()->user()->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        @if(auth()->user()->total_score)
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                <label style="color: #666; font-size: 12px; text-transform: uppercase; display: block; margin-bottom: 5px;">Total Score</label>
                <p style="color: #667eea; font-weight: 700; font-size: 24px;">{{ auth()->user()->total_score }}</p>
            </div>
        @endif
    </div>
@endsection

