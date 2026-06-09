<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel Deenia</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-shell">
    <input type="checkbox" id="admin-menu-toggle" class="admin-menu-checkbox" aria-hidden="true">

    <aside class="sidebar" aria-label="Navigasi admin">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}" aria-label="Admin Panel Deenia">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="Deenia">
            <span>Admin Panel</span>
        </a>

        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link @if(request()->routeIs('admin.dashboard')) active @endif">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-6h-4v6H5a1 1 0 0 1-1-1v-9.5Z"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="sidebar-link @if(request()->routeIs('admin.users.*')) active @endif">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Users</span>
            </a>

            <a href="{{ route('admin.chapters.index') }}" class="sidebar-link @if(request()->routeIs('admin.chapters.*')) active @endif">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15Z"></path>
                </svg>
                <span>Chapters</span>
            </a>

            <a href="{{ route('admin.acts.index') }}" class="sidebar-link @if(request()->routeIs('admin.acts.*')) active @endif">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M8 3h8l2 5H6l2-5Z"></path>
                    <path d="M6 8h12l-1 13H7L6 8Z"></path>
                    <path d="M9 13h6"></path>
                    <path d="M10 17h4"></path>
                </svg>
                <span>Acts</span>
            </a>

            <a href="{{ route('admin.lessons.index') }}" class="sidebar-link @if(request()->routeIs('admin.lessons.*')) active @endif">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M12 6.5A6.5 6.5 0 0 0 5.5 0v17A6.5 6.5 0 0 1 12 23.5"></path>
                    <path d="M12 6.5A6.5 6.5 0 0 1 18.5 0v17A6.5 6.5 0 0 0 12 23.5"></path>
                </svg>
                <span>Lessons</span>
            </a>

            <a href="{{ route('admin.quizzes.index') }}" class="sidebar-link @if(request()->routeIs('admin.quizzes.index') || request()->routeIs('admin.quizzes.create') || request()->routeIs('admin.quizzes.edit') || request()->routeIs('admin.quizzes.show')) active @endif">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9"></circle>
                    <circle cx="12" cy="12" r="4"></circle>
                    <path d="M12 3v3"></path>
                    <path d="M21 12h-3"></path>
                    <path d="M12 21v-3"></path>
                    <path d="M3 12h3"></path>
                </svg>
                <span>Quizzes</span>
            </a>

            <a href="{{ route('admin.quizzes.index') }}" class="sidebar-link @if(request()->routeIs('admin.quizzes.pairs.*')) active @endif">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                </svg>
                <span>Quiz Pairs</span>
            </a>

            <a href="{{ route('admin.progresses.index') }}" class="sidebar-link @if(request()->routeIs('admin.progresses.*')) active @endif">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M3 3v18h18"></path>
                    <path d="M7 15l4-4 3 3 5-7"></path>
                </svg>
                <span>Progress</span>
            </a>
        </nav>

        <form class="sidebar-footer" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M10 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v2"></path>
                    <path d="M15 17l5-5-5-5"></path>
                    <path d="M20 12H8"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <label class="admin-sidebar-backdrop" for="admin-menu-toggle" aria-label="Tutup menu"></label>

    <main class="main-content">
        <header class="topbar">
            <label class="admin-menu-button" for="admin-menu-toggle" aria-label="Buka menu">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <div class="topbar-heading">
                <p class="topbar-kicker">Deenia Admin</p>
                <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="topbar-user">
                <div class="topbar-user-name">{{ auth()->user()->nickname }}</div>
                <div class="topbar-user-role">Admin</div>
            </div>
        </header>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
