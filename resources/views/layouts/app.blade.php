<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Security Assessment Platform')
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f4f6fa;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #101b2d;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 24px 16px;
        }

        .sidebar .brand {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: #b8c4d6;
            text-decoration: none;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #243651;
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            padding: 22px;
        }

        @media(max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <div class="brand">
            <i class="bi bi-shield-lock"></i>
            SecureAssess
        </div>

        <small class="text-secondary">MAIN MENU</small>

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid me-2"></i>
            Dashboard
        </a>

        <a href="{{ route('targets.index') }}" class="nav-link">
            <i class="bi bi-globe me-2"></i>
            Targets
        </a>

        <a href="#">
            <i class="bi bi-search me-2"></i>
            Assessments
        </a>

        <a href="#">
            <i class="bi bi-bug me-2"></i>
            Findings
        </a>

        <a href="#">
            <i class="bi bi-file-earmark-text me-2"></i>
            Reports
        </a>

        <hr class="border-secondary">

        <small class="text-secondary">ACCOUNT</small>

        <div class="mt-3 mb-3">
            <div>{{ auth()->user()->name }}</div>

            <small class="text-secondary">
                {{ ucfirst(auth()->user()->role) }}
            </small>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="btn btn-outline-light btn-sm w-100">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </button>
        </form>

    </div>

    <main class="main-content">

        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>