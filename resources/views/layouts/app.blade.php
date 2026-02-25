<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])
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
