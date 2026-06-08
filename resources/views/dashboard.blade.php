@extends('layouts.user')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/learn.css') }}">
@endpush

@section('content')
    <main class="learn-page">
        <section class="learn-empty-state">
            <img src="{{ asset('assets/images/mascot-curious.webp') }}" alt="">
            <h1>Dashboard pindah ke Learn</h1>
            <p>Halaman utama belajar Deenia sekarang ada di route Learn.</p>
            <a class="chapter-cta" href="{{ route('learn') }}">Buka Learn</a>
        </section>
    </main>
@endsection
