@extends('layouts.user')

@section('title', 'Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endpush

@section('content')
    @php
        $avatarUrl = $user->avatar
            ? asset('storage/' . $user->avatar)
            : asset('assets/images/mascot-wave.webp');
        $joinedDate = $user->created_at
            ? $user->created_at->locale('id')->translatedFormat('d F Y')
            : '-';
        $birthDate = $user->tanggal_lahir
            ? \Carbon\Carbon::parse($user->tanggal_lahir)
            : null;
        $birthDateValue = $birthDate?->format('Y-m-d') ?? '';
        $birthDateLabel = $birthDate
            ? $birthDate->locale('id')->translatedFormat('d F Y')
            : '-';
        $genderLabel = match ($user->gender) {
            'male' => 'Male',
            'female' => 'Female',
            default => '-',
        };
        $chapterTitle = $currentChapter?->name ?? 'Belum mulai';
        $chapterDetail = $currentAct
            ? 'Act ' . $currentAct->order_number . ' - ' . $currentAct->name
            : ($currentQuiz?->title ?? null);
    @endphp

    <main class="profile-page">
        <input
            type="checkbox"
            id="profile-edit-toggle"
            class="profile-edit-toggle"
            @checked($errors->any())
            aria-hidden="true"
        >

        <section class="profile-hero-card" aria-labelledby="profile-name">
            <div class="profile-avatar-frame">
                <img class="profile-avatar" src="{{ $avatarUrl }}" alt="Avatar {{ $user->nickname }}">
                <span class="profile-avatar-badge" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 8.5A2.5 2.5 0 0 1 6.5 6H9l1.5-2h3L15 6h2.5A2.5 2.5 0 0 1 20 8.5v8A2.5 2.5 0 0 1 17.5 19h-11A2.5 2.5 0 0 1 4 16.5v-8Z"></path>
                        <path d="M9 12.5a3 3 0 1 0 6 0 3 3 0 0 0-6 0Z"></path>
                    </svg>
                </span>
            </div>

            <div class="profile-hero-copy">
                <div class="profile-title-row">
                    <h1 id="profile-name">{{ $user->nickname }}</h1>
                    <label class="profile-icon-button" for="profile-edit-toggle" aria-label="Edit profile" role="button" tabindex="0">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 20h4l10.5-10.5a2.1 2.1 0 0 0-3-3L5 17v3Z"></path>
                            <path d="m14 7 3 3"></path>
                        </svg>
                    </label>
                </div>
                <p class="profile-email">{{ $user->email }}</p>
                <p class="profile-joined">Bergabung {{ $joinedDate }}</p>
            </div>
        </section>

        <section class="profile-edit-card" aria-labelledby="profile-edit-title">
            <div class="profile-card-heading">
                <h2 id="profile-edit-title">Edit Profile</h2>
                <label class="profile-close-button" for="profile-edit-toggle" aria-label="Tutup form edit" role="button" tabindex="0">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6 6l12 12"></path>
                        <path d="M18 6 6 18"></path>
                    </svg>
                </label>
            </div>

            @if($errors->any())
                <div class="profile-error-box" role="alert">
                    <p>Periksa kembali data profile.</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="profile-form" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="profile-form-grid">
                    <label class="profile-field" for="nickname">
                        <span>Nickname</span>
                        <input
                            id="nickname"
                            type="text"
                            name="nickname"
                            value="{{ old('nickname', $user->nickname) }}"
                            required
                            autocomplete="nickname"
                        >
                        @error('nickname')
                            <small>{{ $message }}</small>
                        @enderror
                    </label>

                    <label class="profile-field" for="email">
                        <span>Email</span>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            autocomplete="email"
                        >
                        @error('email')
                            <small>{{ $message }}</small>
                        @enderror
                    </label>

                    <fieldset class="profile-field profile-gender-field">
                        <legend>Gender</legend>
                        <div class="profile-radio-group">
                            <label>
                                <input
                                    type="radio"
                                    name="gender"
                                    value="male"
                                    @checked(old('gender', $user->gender) === 'male')
                                >
                                <span>Male</span>
                            </label>
                            <label>
                                <input
                                    type="radio"
                                    name="gender"
                                    value="female"
                                    @checked(old('gender', $user->gender) === 'female')
                                >
                                <span>Female</span>
                            </label>
                        </div>
                        @error('gender')
                            <small>{{ $message }}</small>
                        @enderror
                    </fieldset>

                    <label class="profile-field" for="tanggal_lahir">
                        <span>Tanggal Lahir</span>
                        <input
                            id="tanggal_lahir"
                            type="date"
                            name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $birthDateValue) }}"
                        >
                        @error('tanggal_lahir')
                            <small>{{ $message }}</small>
                        @enderror
                    </label>

                    <label class="profile-field profile-file-field" for="avatar">
                        <span>Avatar</span>
                        <input
                            id="avatar"
                            type="file"
                            name="avatar"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        >
                        @error('avatar')
                            <small>{{ $message }}</small>
                        @enderror
                    </label>
                </div>

                <div class="profile-form-actions">
                    <button class="profile-save-button" type="submit">Simpan</button>
                    <label class="profile-cancel-button" for="profile-edit-toggle" role="button" tabindex="0">Batal</label>
                </div>
            </form>
        </section>

        <section class="profile-content-grid" aria-label="Ringkasan profile">
            <article class="profile-card profile-info-card">
                <h2>Information</h2>

                <dl class="profile-info-list">
                    <div>
                        <dt>
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"></path>
                                <path d="M4.5 21a7.5 7.5 0 0 1 15 0"></path>
                            </svg>
                            <span>Nickname</span>
                        </dt>
                        <dd>
                            <strong>{{ $user->nickname }}</strong>
                            <label class="profile-inline-edit" for="profile-edit-toggle" aria-label="Edit nickname" role="button" tabindex="0">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M4 20h4l10.5-10.5a2.1 2.1 0 0 0-3-3L5 17v3Z"></path>
                                    <path d="m14 7 3 3"></path>
                                </svg>
                            </label>
                        </dd>
                    </div>

                    <div>
                        <dt>
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 6h16v12H4z"></path>
                                <path d="m4 7 8 6 8-6"></path>
                            </svg>
                            <span>Email</span>
                        </dt>
                        <dd>
                            <span>{{ $user->email }}</span>
                            <label class="profile-inline-edit" for="profile-edit-toggle" aria-label="Edit email" role="button" tabindex="0">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M4 20h4l10.5-10.5a2.1 2.1 0 0 0-3-3L5 17v3Z"></path>
                                    <path d="m14 7 3 3"></path>
                                </svg>
                            </label>
                        </dd>
                    </div>

                    <div>
                        <dt>
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M7 5h10"></path>
                                <path d="M12 5v14"></path>
                                <path d="M8 19h8"></path>
                                <path d="M8.5 9.5a3.5 3.5 0 1 0 7 0 3.5 3.5 0 0 0-7 0Z"></path>
                            </svg>
                            <span>Gender</span>
                        </dt>
                        <dd>
                            <span>{{ $genderLabel }}</span>
                            <label class="profile-inline-edit" for="profile-edit-toggle" aria-label="Edit gender" role="button" tabindex="0">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M4 20h4l10.5-10.5a2.1 2.1 0 0 0-3-3L5 17v3Z"></path>
                                    <path d="m14 7 3 3"></path>
                                </svg>
                            </label>
                        </dd>
                    </div>

                    <div>
                        <dt>
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M7 3v4"></path>
                                <path d="M17 3v4"></path>
                                <path d="M4 8h16"></path>
                                <path d="M5 5h14v15H5z"></path>
                            </svg>
                            <span>Tanggal Lahir</span>
                        </dt>
                        <dd>
                            <span>{{ $birthDateLabel }}</span>
                            <label class="profile-inline-edit" for="profile-edit-toggle" aria-label="Edit tanggal lahir" role="button" tabindex="0">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M4 20h4l10.5-10.5a2.1 2.1 0 0 0-3-3L5 17v3Z"></path>
                                    <path d="m14 7 3 3"></path>
                                </svg>
                            </label>
                        </dd>
                    </div>
                </dl>
            </article>

            <div class="profile-side-stack">
                <article class="profile-card profile-chapter-card">
                    <p>Chapter:</p>
                    <h2>{{ $chapterTitle }}</h2>
                    @if($chapterDetail)
                        <span>{{ $chapterDetail }}</span>
                    @endif
                </article>

                <article class="profile-card profile-score-card">
                    <p>Total Score:</p>
                    <strong>{{ number_format((int) $user->total_score) }}</strong>
                </article>
            </div>

            <article class="profile-card profile-progress-card">
                <div class="profile-progress-heading">
                    <div>
                        <p>Progress</p>
                        <h2>{{ $progressSummary['progress_percentage'] }}% selesai</h2>
                    </div>
                    <strong>{{ $progressSummary['passed_quizzes'] }} / {{ $progressSummary['total_quizzes'] }}</strong>
                </div>

                <progress
                    class="profile-progress-meter"
                    value="{{ $progressSummary['progress_percentage'] }}"
                    max="100"
                    aria-label="Progress belajar {{ $progressSummary['progress_percentage'] }} persen"
                ></progress>

                <dl class="profile-progress-stats">
                    <div>
                        <dt>Total Quiz Selesai</dt>
                        <dd>{{ $progressSummary['completed_quizzes'] }}</dd>
                    </div>
                    <div>
                        <dt>Total Quiz Lulus</dt>
                        <dd>{{ $progressSummary['passed_quizzes'] }}</dd>
                    </div>
                    <div>
                        <dt>Persentase Progress</dt>
                        <dd>{{ $progressSummary['progress_percentage'] }}%</dd>
                    </div>
                </dl>
            </article>
        </section>
    </main>
@endsection
