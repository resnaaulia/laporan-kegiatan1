<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@if(auth()->check())
<div class="navbar">
    <div><b>Laporan Kegiatan</b></div>
    <div>
        {{ auth()->user()->name }} |
        <form action="/logout" method="POST" style="display:inline">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>
@endif

<div class="container">
    @yield('content')
</div>

</body>
</html>
