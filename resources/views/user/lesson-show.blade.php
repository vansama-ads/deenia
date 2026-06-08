@extends('layouts.user')

@section('title', $lesson->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/lesson-show.css') }}">
@endpush

@section('content')
    @php
        $avatarUrl = $user->avatar
            ? asset('storage/' . $user->avatar)
            : asset('assets/images/mascot-wave.webp');
    @endphp

    <main class="lesson-page">
        <section class="lesson-reader" aria-label="Konten lesson">
            <a class="lesson-back-link" href="{{ route('learn') }}">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M19 12H5"></path>
                    <path d="m12 19-7-7 7-7"></path>
                </svg>
                <span>Kembali</span>
            </a>

            <article class="lesson-article">
                <header class="lesson-header">
                    <p>Chapter {{ $chapter->order_number }} / Act {{ $act->order_number }}</p>
                    <h1>{{ $lesson->title }}</h1>
                </header>

                <div class="lesson-content markdown-content">
                    {!! \Illuminate\Support\Str::markdown($lesson->content ?? '', [
                        'html_input' => 'strip',
                        'allow_unsafe_links' => false,
                    ]) !!}
                </div>

                <footer class="lesson-actions">
                    <a class="lesson-continue-button" href="{{ $continueUrl }}">Lanjutkan</a>
                </footer>
            </article>
        </section>

        <aside class="lesson-sidebar" aria-label="Ringkasan belajar">
            <section class="lesson-card lesson-user-card">
                <img class="lesson-avatar" src="{{ $avatarUrl }}" alt="Avatar {{ $user->nickname }}">
                <div>
                    <p class="lesson-card-kicker">Learner</p>
                    <h2>{{ $user->nickname }}</h2>
                    <dl class="lesson-user-stats">
                        <div>
                            <dt>Total Score</dt>
                            <dd>{{ number_format((int) $user->total_score) }}</dd>
                        </div>
                        <div>
                            <dt>Level</dt>
                            <dd>{{ $userLevel }}</dd>
                        </div>
                    </dl>
                </div>
            </section>

            <section class="lesson-card">
                <p class="lesson-card-kicker">Progress</p>
                <h2>{{ $summary['progress_percentage'] }}% selesai</h2>
                <progress class="lesson-progress-meter" value="{{ $summary['progress_percentage'] }}" max="100" aria-label="Progress {{ $summary['progress_percentage'] }}%"></progress>
                <dl class="lesson-metric-list">
                    <div>
                        <dt>Total Quiz Selesai</dt>
                        <dd>{{ $summary['completed_quizzes'] }} / {{ $summary['total_quizzes'] }}</dd>
                    </div>
                    <div>
                        <dt>Total Lesson Selesai</dt>
                        <dd>{{ $summary['completed_lessons'] }} / {{ $summary['total_lessons'] }}</dd>
                    </div>
                    <div>
                        <dt>Persentase Progress</dt>
                        <dd>{{ $summary['progress_percentage'] }}%</dd>
                    </div>
                </dl>
            </section>

            <section class="lesson-card">
                <p class="lesson-card-kicker">Current Progress</p>
                <h2>{{ $lesson->title }}</h2>
                <dl class="lesson-metric-list">
                    <div>
                        <dt>Chapter Aktif</dt>
                        <dd>Chapter {{ $chapter->order_number }}: {{ $chapter->name }}</dd>
                    </div>
                    <div>
                        <dt>Act Aktif</dt>
                        <dd>Act {{ $act->order_number }}: {{ $act->name }}</dd>
                    </div>
                    <div>
                        <dt>Lesson Aktif</dt>
                        <dd>{{ $lesson->title }}</dd>
                    </div>
                </dl>
            </section>
        </aside>
    </main>
@endsection
