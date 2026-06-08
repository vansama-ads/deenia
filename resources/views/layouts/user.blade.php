<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Learn') - Deenia</title>
    <link rel="stylesheet" href="{{ asset('assets/css/user-layout.css') }}">
    @stack('styles')
</head>
<body class="user-shell">
    <input type="checkbox" id="user-menu-toggle" class="user-menu-checkbox" aria-hidden="true">

    <aside class="user-sidebar" aria-label="Navigasi user">
        <a class="user-brand" href="{{ route('learn') }}" aria-label="Deenia Learn">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="Deenia">
        </a>

        <nav class="user-nav">
            <a class="user-nav-link {{ request()->routeIs('learn') ? 'is-active' : '' }}" href="{{ route('learn') }}">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-6h-4v6H5a1 1 0 0 1-1-1v-9.5Z"></path>
                </svg>
                <span>Learn</span>
            </a>

            <a class="user-nav-link {{ request()->routeIs('users.show') ? 'is-active' : '' }}" href="{{ route('users.show', auth()->id()) }}">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"></path>
                    <path d="M4.5 21a7.5 7.5 0 0 1 15 0"></path>
                </svg>
                <span>Profile</span>
            </a>
        </nav>

        <form class="user-logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="user-logout-button">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M10 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v2"></path>
                    <path d="M15 17l5-5-5-5"></path>
                    <path d="M20 12H8"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <label class="user-sidebar-backdrop" for="user-menu-toggle" aria-label="Tutup menu"></label>

    <div class="user-main">
        <header class="user-mobile-header">
            <label class="user-menu-button" for="user-menu-toggle" aria-label="Buka menu">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <a class="user-mobile-brand" href="{{ route('learn') }}">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="Deenia">
            </a>
        </header>

        @if(session('success'))
            <div class="user-alert user-alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="user-alert user-alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
