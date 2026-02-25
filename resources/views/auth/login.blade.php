@extends('layouts.app')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Laporan Pegawai</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="login-wrapper">

    <div class="login-info">
        <h1>Sistem Laporan<br>Kegiatan Pegawai</h1>
        <p>Kelola dan laporkan kegiatan kerja secara rapi dan terstruktur.</p>
    </div>

    <div class="login-card">
        <h2>Login</h2>

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            @if ($errors->any())
                <p style="color:red">{{ $errors->first() }}</p>
            @endif

            <button type="submit">Login</button>
        </form>
    </div>

</div>

</body>
</html>
