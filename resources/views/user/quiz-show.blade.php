@extends('layouts.user')

@section('title', $quiz->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/quiz-show.css') }}">
@endpush

@section('content')
    @php
        $avatarUrl = $user->avatar
            ? asset('storage/' . $user->avatar)
            : asset('assets/images/mascot-wave.webp');
        $result = session('quiz_result');
        $pairCount = max(1, $pairs->count());
        $answeredCount = $result ? $result['total'] : 1;
        $quizPercent = $result ? 100 : round(($answeredCount / $pairCount) * 100);
    @endphp

    <main class="quiz-page">
        <section class="quiz-stage" aria-label="Quiz matching pair">
            <header class="quiz-topbar">
                <a class="quiz-close-link" href="{{ route('learn') }}" aria-label="Kembali ke Learn">
                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </a>

                <div class="quiz-progress-wrap" aria-label="Progress quiz">
                    <progress class="quiz-progress" value="{{ $quizPercent }}" max="100"></progress>
                    <p>Question {{ $answeredCount }} dari {{ $pairCount }}</p>
                </div>

                <div class="quiz-lives" aria-label="Health 5">
                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <path d="M12 21s-7.5-4.6-9.6-9.1C.8 8.5 2.8 4.5 6.5 4.5c2.1 0 3.5 1.1 4.4 2.4.9-1.3 2.3-2.4 4.4-2.4 3.7 0 5.7 4 4.1 7.4C19.5 16.4 12 21 12 21Z"></path>
                    </svg>
                    <span>5</span>
                </div>
            </header>

            <article class="quiz-card">
                <p class="quiz-kicker">Chapter {{ $chapter->order_number }} / Act {{ $act->order_number }}</p>
                <h1>Jawab pertanyaan berikut dengan benar</h1>
                <h2>{{ $quiz->title }}</h2>

                @if($errors->has('answers'))
                    <p class="quiz-form-error">{{ $errors->first('answers') }}</p>
                @endif

                @if($result)
                    <section class="quiz-result" aria-label="Hasil quiz">
                        <dl>
                            <div>
                                <dt>Score</dt>
                                <dd>{{ $result['score'] }}</dd>
                            </div>
                            <div>
                                <dt>Benar</dt>
                                <dd>{{ $result['correct'] }} / {{ $result['total'] }}</dd>
                            </div>
                            <div>
                                <dt>Status</dt>
                                <dd>{{ $result['passed'] ? 'Lulus' : 'Tidak Lulus' }}</dd>
                            </div>
                        </dl>
                    </section>
                @endif

                <form class="quiz-form" action="{{ route('user.quizzes.submit', $quiz) }}" method="POST">
                    @csrf

                    <div class="matching-list">
                        @forelse($pairs as $pair)
                            <div class="matching-row">
                                <div class="matching-left">
                                    <span>{{ $pair->left_text }}</span>
                                </div>

                                <span class="matching-dot" aria-hidden="true"></span>

                                <label class="matching-select-label">
                                    <span>Pilih pasangan untuk {{ $pair->left_text }}</span>
                                    <select name="answers[{{ $pair->id }}]" required>
                                        <option value="" disabled {{ old('answers.' . $pair->id) ? '' : 'selected' }}>Pilih jawaban</option>
                                        @foreach($rightOptions as $option)
                                            <option value="{{ $option }}" @selected(old('answers.' . $pair->id) === $option)>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        @empty
                            <p class="quiz-empty">Quiz ini belum memiliki pasangan jawaban.</p>
                        @endforelse
                    </div>

                    <footer class="quiz-actions">
                        <button class="quiz-submit-button" type="submit" @disabled($pairs->isEmpty())>
                            Kirim jawaban
                        </button>

                        @if($result && $result['passed'])
                            <a class="quiz-secondary-link" href="{{ route('learn') }}">Kembali ke Learn</a>
                        @endif
                    </footer>
                </form>
            </article>
        </section>

        <aside class="quiz-sidebar" aria-label="Ringkasan belajar">
            <section class="quiz-side-card quiz-user-card">
                <img class="quiz-avatar" src="{{ $avatarUrl }}" alt="Avatar {{ $user->nickname }}">
                <div>
                    <p class="quiz-side-kicker">Learner</p>
                    <h2>{{ $user->nickname }}</h2>
                    <dl class="quiz-user-stats">
                        <div>
                            <dt>Total Score</dt>
                            <dd>{{ number_format((int) $user->fresh()->total_score) }}</dd>
                        </div>
                        <div>
                            <dt>Level</dt>
                            <dd>{{ $userLevel }}</dd>
                        </div>
                    </dl>
                </div>
            </section>

            <section class="quiz-side-card">
                <p class="quiz-side-kicker">Progress</p>
                <h2>{{ $summary['progress_percentage'] }}% selesai</h2>
                <progress class="quiz-side-progress" value="{{ $summary['progress_percentage'] }}" max="100" aria-label="Progress {{ $summary['progress_percentage'] }}%"></progress>
                <dl class="quiz-metric-list">
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

            <section class="quiz-side-card">
                <p class="quiz-side-kicker">Current Act</p>
                <h2>{{ $quiz->title }}</h2>
                <dl class="quiz-metric-list">
                    <div>
                        <dt>Chapter Aktif</dt>
                        <dd>Chapter {{ $chapter->order_number }}: {{ $chapter->name }}</dd>
                    </div>
                    <div>
                        <dt>Act Aktif</dt>
                        <dd>Act {{ $act->order_number }}: {{ $act->name }}</dd>
                    </div>
                    <div>
                        <dt>Quiz Aktif</dt>
                        <dd>{{ $quiz->title }}</dd>
                    </div>
                </dl>
            </section>
        </aside>
    </main>
@endsection
