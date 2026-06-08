<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel Deenia</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #1a1a2e;
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            padding: 20px 25px;
            font-size: 22px;
            font-weight: 700;
            color: #667eea;
            border-bottom: 2px solid #667eea;
            margin-bottom: 20px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: #b8b8c8;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover {
            background: #2a2a4e;
            color: white;
            border-left-color: #667eea;
        }

        .sidebar-menu a.active {
            background: #2a2a4e;
            color: #667eea;
            border-left-color: #667eea;
            font-weight: 600;
        }

        .sidebar-menu a span {
            margin-left: 12px;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 25px;
        }

        .logout-btn {
            width: 100%;
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #c82333;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            display: flex;
            flex-direction: column;
        }

        /* Top Bar */
        .topbar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .topbar-user {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .topbar-user-name {
            color: #333;
            font-weight: 600;
        }

        .topbar-user-role {
            color: #666;
            font-size: 12px;
        }

        /* Content Area */
        .content {
            flex: 1;
            padding: 30px;
        }

        /* Alert Messages */
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-color: #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-color: #dc3545;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-color: #17a2b8;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-header {
            border-bottom: 2px solid #667eea;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        /* Button */
        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #1a1a2e;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 3px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
                transition: transform 0.3s;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .toggle-sidebar {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">🎓 Admin Panel</div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="@if(request()->routeIs('admin.dashboard')) active @endif">
                    <span>📊 Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="@if(request()->routeIs('admin.users.*')) active @endif">
                    <span>👥 Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.chapters.index') }}" class="@if(request()->routeIs('admin.chapters.*')) active @endif">
                    <span>📚 Chapters</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.acts.index') }}" class="@if(request()->routeIs('admin.acts.*')) active @endif">
                    <span>🎭 Acts</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.lessons.index') }}" class="@if(request()->routeIs('admin.lessons.*')) active @endif">
                    <span>📖 Lessons</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.quizzes.index') }}" class="@if(request()->routeIs('admin.quizzes.*')) active @endif">
                    <span>🎯 Quizzes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.progresses.index') }}" class="@if(request()->routeIs('admin.progresses.*')) active @endif">
                    <span>📊 Progress Quiz</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            <div class="topbar-user">
                <div class="topbar-user-name">{{ auth()->user()->nickname }}</div>
                <div class="topbar-user-role">Admin</div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="alert alert-error">
                    ✗ {{ session('error') }}
                </div>
            @endif

            <!-- Content Section -->
            @yield('content')
        </div>
    </div>
</body>
</html>
