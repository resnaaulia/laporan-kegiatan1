<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="admin-page">

<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2 class="logo">Admin</h2>

        <ul class="menu">

            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
                <a href="{{ route('admin.pegawai.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Pegawai</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <a href="{{ route('admin.laporan.index') }}">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Data Laporan</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.persetujuan.*') ? 'active' : '' }}">
                <a href="{{ route('admin.persetujuan.index') }}">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Persetujuan</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.rekap.*') ? 'active' : '' }}">
                <a href="{{ route('admin.rekap.index') }}">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Rekap</span>
                </a>
            </li>

        </ul>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </aside>

    <!-- CONTENT -->
    <main class="content">
        @yield('content')
    </main>

</div>

</body>
</html>
