<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Deenia</title>
    <link rel="icon" href="{{ asset('assets/images/logo.webp') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <main class="auth-page auth-page-login">
        <a class="auth-back" href="{{ url('/') }}" aria-label="Kembali ke halaman utama">
            <span aria-hidden="true">&lsaquo;</span>
        </a>

        <section class="auth-card auth-card-login" aria-labelledby="login-title">
            <div class="auth-visual">
                <h2 class="auth-welcome">Welcome<br>Back!</h2>
                <img
                    class="auth-mascot auth-mascot-login"
                    src="{{ asset('assets/images/mascot-wave.webp') }}"
                    alt="Maskot Deenia melambaikan tangan"
                >
            </div>

            <div class="auth-form-panel">
                <div class="auth-form-inner">
                    <h1 id="login-title" class="auth-title">Masuk</h1>

                    @if($errors->any())
                        <div class="auth-alert" role="alert">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="auth-form" action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="auth-field">
                            <label class="sr-only" for="email">Email atau Nickname</label>
                            <input
                                class="auth-input"
                                type="text"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Email atau Nickname"
                                inputmode="email"
                                autocomplete="username"
                                required
                                autofocus
                            >
                            @error('email')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="auth-field">
                            <label class="sr-only" for="password">Password</label>
                            <input
                                class="auth-input"
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Password"
                                autocomplete="current-password"
                                required
                            >
                            @error('password')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="auth-button" type="submit">Masuk</button>
                    </form>

                    <p class="auth-link-text">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
                    </p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
