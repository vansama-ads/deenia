<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Deenia</title>
    <link rel="icon" href="{{ asset('assets/images/logo.webp') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <main class="auth-page auth-page-register">
        <a class="auth-back" href="{{ url('/') }}" aria-label="Kembali ke halaman utama">
            <span aria-hidden="true">&lsaquo;</span>
        </a>

        <section class="auth-card auth-card-register" aria-labelledby="register-title">
            <div class="auth-visual">
                <h2 class="auth-welcome">Welcome to<br>the Adventure</h2>
                <img
                    class="auth-mascot auth-mascot-register"
                    src="{{ asset('assets/images/mascot-wave.webp') }}"
                    alt="Maskot Deenia melambaikan tangan"
                >
            </div>

            <div class="auth-form-panel">
                <div class="auth-form-inner">
                    <h1 id="register-title" class="auth-title">Daftar</h1>

                    @if($errors->any())
                        <div class="auth-alert" role="alert">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="auth-form" id="register-form" action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="auth-field">
                            <label class="sr-only" for="nickname">Nickname</label>
                            <input
                                class="auth-input"
                                type="text"
                                id="nickname"
                                name="nickname"
                                value="{{ old('nickname') }}"
                                placeholder="Nickname"
                                autocomplete="nickname"
                                required
                                autofocus
                            >
                            @error('nickname')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="auth-field">
                            <label class="sr-only" for="tanggal_lahir">Tanggal Lahir</label>
                            <input
                                class="auth-input"
                                type="{{ old('tanggal_lahir') ? 'date' : 'text' }}"
                                id="tanggal_lahir"
                                name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}"
                                placeholder="Tanggal Lahir"
                                autocomplete="bday"
                                onfocus="this.type='date'"
                                onblur="if (!this.value) this.type='text'"
                            >
                            @error('tanggal_lahir')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <fieldset class="auth-radio-group">
                            <legend class="sr-only">Gender</legend>
                            <label class="auth-radio">
                                <input
                                    type="radio"
                                    name="gender"
                                    value="male"
                                    {{ old('gender') === 'male' ? 'checked' : '' }}
                                >
                                <span class="auth-radio-dot" aria-hidden="true"></span>
                                <span>Laki-Laki</span>
                            </label>

                            <label class="auth-radio">
                                <input
                                    type="radio"
                                    name="gender"
                                    value="female"
                                    {{ old('gender') === 'female' ? 'checked' : '' }}
                                >
                                <span class="auth-radio-dot" aria-hidden="true"></span>
                                <span>Perempuan</span>
                            </label>
                        </fieldset>

                        <div class="auth-field">
                            <label class="sr-only" for="email">Email</label>
                            <input
                                class="auth-input"
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Email"
                                autocomplete="email"
                                required
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
                                autocomplete="new-password"
                                required
                            >
                            <input
                                type="hidden"
                                id="password_confirmation"
                                name="password_confirmation"
                            >
                            @error('password')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                            @error('password_confirmation')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="auth-button" type="submit">Daftar</button>
                    </form>

                    <p class="auth-link-text">
                        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                    </p>
                </div>
            </div>
        </section>
    </main>

    <script>
        (function () {
            var password = document.getElementById('password');
            var confirmation = document.getElementById('password_confirmation');
            var form = document.getElementById('register-form');

            if (!password || !confirmation) {
                return;
            }

            var syncPassword = function () {
                confirmation.value = password.value;
            };

            password.addEventListener('input', syncPassword);
            form.addEventListener('submit', syncPassword);
            syncPassword();
        })();
    </script>
</body>
</html>
