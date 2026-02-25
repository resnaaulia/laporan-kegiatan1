<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pegawai Panel</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=3">
</head>

<body class="pegawai-page">

<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2 class="logo">Pegawai Panel</h2>

        <ul class="menu">
    <li>
        <a href="{{ route('pegawai.dashboard') }}"
           class="menu-item {{ request()->routeIs('pegawai.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
    </li>

    <li>
        <a href="{{ route('pegawai.laporan.create') }}"
           class="menu-item {{ request()->routeIs('pegawai.laporan.create') ? 'active' : '' }}">
            Buat Laporan
        </a>
    </li>

    <li>
        <a href="{{ route('pegawai.laporan.index') }}"
           class="menu-item {{ request()->routeIs('pegawai.laporan.index') ? 'active' : '' }}">
            Riwayat Laporan
        </a>
    </li>
</ul>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>
    </aside>

    <!-- CONTENT -->
    <main class="content">
        <div class="content-inner">
            @yield('content')
        </div>
    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>