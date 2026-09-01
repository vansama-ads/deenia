@extends('layouts.user')

@section('title', 'Learn')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/learn.css') }}">
@endpush

@section('content')
    @php
        $avatarUrl = $user->avatar_url;
        $activeActState = $activeAct ? ($actStateById[$activeAct->id] ?? null) : null;
        $activeActProgress = $activeActState['quiz_progress'] ?? null;
        $startLesson = $activeAct?->lessons->first();
    @endphp

    <main class="learn-page">
        <section class="learn-track" aria-label="Jalur belajar">
            @if($activeChapter)
                <div class="chapter-hero">
                    <div>
                        <p>Chapter {{ $activeChapter->order_number }}:</p>
                        <h1>{{ $activeChapter->name }}</h1>
                    </div>

                    @if($startLesson && ($activeActState['unlocked'] ?? false))
                        <a class="chapter-cta" href="{{ route('user.lessons.show', $startLesson) }}">
                            <svg aria-hidden="true" viewBox="0 0 24 24">
                                <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"></path>
                                <path d="M4 5.5A2.5 2.5 0 0 1 6.5 8H20"></path>
                            </svg>
                            <span>Lesson</span>
                        </a>
                    @endif
                </div>

                <div class="learn-path">
                    @foreach($activeChapter->acts as $act)
                        @php
                            $state = $actStateById[$act->id] ?? ['unlocked' => false, 'completed' => false, 'quiz_progress' => null];
                            $actUnlocked = $state['unlocked'];
                        @endphp

                        <section class="act-section" aria-labelledby="act-{{ $act->id }}">
                            <div class="act-separator">
                                <span></span>
                                <h2 id="act-{{ $act->id }}">Act {{ $act->order_number }}</h2>
                                <span></span>
                            </div>

                            <p class="act-name">{{ $act->name }}</p>

                            <div class="node-lane">
                                @foreach($act->lessons as $lesson)
                                    @php
                                        $lessonDone = $lessonCompletionByAct[$act->id] ?? false;
                                        $nodeState = !$actUnlocked ? 'is-locked' : ($lessonDone ? 'is-completed' : 'is-open');
                                        $offset = 'node-offset-' . (($loop->index % 5) + 1);
                                    @endphp

                                    @if($actUnlocked)
                                        <a class="path-node lesson-node {{ $nodeState }} {{ $offset }}"
                                           href="{{ route('user.lessons.show', $lesson) }}"
                                           aria-label="Lesson {{ $loop->iteration }}: {{ $lesson->title }}">
                                            @include('user.partials.node-icon', ['state' => $nodeState, 'type' => 'lesson'])
                                            <span>Lesson {{ $loop->iteration }}</span>
                                        </a>
                                    @else
                                        <div class="path-node lesson-node {{ $nodeState }} {{ $offset }}" aria-disabled="true">
                                            @include('user.partials.node-icon', ['state' => $nodeState, 'type' => 'lesson'])
                                            <span>Lesson {{ $loop->iteration }}</span>
                                        </div>
                                    @endif
                                @endforeach

                                @if($act->quiz)
                                    @php
                                        $quizDone = (bool) optional($state['quiz_progress'])->passed;
                                        $quizState = !$actUnlocked ? 'is-locked' : ($quizDone ? 'is-completed' : 'is-open');
                                        $quizOffset = 'node-offset-' . ((($act->lessons->count() % 5) + 1));
                                    @endphp

                                    @if($actUnlocked)
                                        <a class="path-node quiz-node {{ $quizState }} {{ $quizOffset }}"
                                           href="{{ route('user.quizzes.show', $act->quiz) }}"
                                           aria-label="Quiz: {{ $act->quiz->title }}">
                                            @include('user.partials.node-icon', ['state' => $quizState, 'type' => 'quiz'])
                                            <span>Quiz</span>
                                        </a>
                                    @else
                                        <div class="path-node quiz-node {{ $quizState }} {{ $quizOffset }}" aria-disabled="true">
                                            @include('user.partials.node-icon', ['state' => $quizState, 'type' => 'quiz'])
                                            <span>Quiz</span>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </section>
                    @endforeach
                </div>
            @else
                <div class="learn-empty-state">
                    <img src="{{ asset('assets/images/mascot-curious.webp') }}" alt="">
                    <h1>Belum ada chapter</h1>
                    <p>Tambahkan chapter, act, lesson, dan quiz dari admin panel untuk memulai jalur belajar.</p>
                </div>
            @endif
        </section>

        <aside class="learn-sidebar" aria-label="Ringkasan belajar">
            <section class="learn-card user-card">
                <img class="user-avatar" src="{{ $avatarUrl }}" alt="Avatar {{ $user->nickname }}">
                <div>
                    <p class="card-kicker">Learner</p>
                    <h2>{{ $user->nickname }}</h2>
                    <dl class="user-stats">
                        <div>
                            <dt>Total Score</dt>
                            <dd>{{ number_format((int) $user->total_score) }}</dd>
                        </div>
                    </dl>
                </div>
            </section>

            <section class="learn-card">
                <p class="card-kicker">Progress</p>
                <h2>{{ $summary['progress_percentage'] }}% selesai</h2>
                <progress class="progress-meter" value="{{ $summary['progress_percentage'] }}" max="100" aria-label="Progress {{ $summary['progress_percentage'] }}%"></progress>
                <dl class="metric-list">
                    <div>
                        <dt>Total Quiz Selesai</dt>
                        <dd>{{ $summary['completed_quizzes'] }} / {{ $summary['total_quizzes'] }}</dd>
                    </div>
                    <div>
                        <dt>Total Lesson Selesai</dt>
                        <dd>{{ $summary['completed_lessons'] }} / {{ $summary['total_lessons'] }}</dd>
                    </div>
                </dl>
            </section>

            <section class="learn-card">
                <p class="card-kicker">Current Chapter</p>
                <h2>{{ $activeChapter?->name ?? 'Belum tersedia' }}</h2>
                <dl class="metric-list">
                    <div>
                        <dt>Act Aktif</dt>
                        <dd>{{ $activeAct ? 'Act ' . $activeAct->order_number : '-' }}</dd>
                    </div>
                    <div>
                        <dt>Progress Saat Ini</dt>
                        <dd>
                            @if($activeActProgress)
                                {{ $activeActProgress->passed ? 'Lulus' : 'Coba lagi' }} - {{ $activeActProgress->score }}
                            @else
                                Belum mulai
                            @endif
                        </dd>
                    </div>
                </dl>
            </section>
        </aside>
    </main>
@endsection
