@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<div class="page-head">
    <div>
        <h2 class="page-title">Dashboard Admin</h2>
        <p class="page-subtitle"></p>
    </div>
</div>

<!-- STAT CARDS -->
<div class="dashboard-cards">

    <div class="stat-card blue">
        <i class="fa-solid fa-users"></i>
        <div>
            <h2>{{ $totalPegawai }}</h2>
            <p>Total Pegawai</p>
        </div>
    </div>

    <div class="stat-card green">
        <i class="fa-solid fa-file-lines"></i>
        <div>
            <h2>{{ $totalLaporan }}</h2>
            <p>Total Laporan</p>
        </div>
    </div>

    <div class="stat-card orange">
        <i class="fa-solid fa-clock"></i>
        <div>
            <h2>{{ $laporanHariIni }}</h2>
            <p>Laporan Hari Ini</p>
        </div>
    </div>

    <div class="stat-card red">
        <i class="fa-solid fa-circle-exclamation"></i>
        <div>
            <h2>{{ $menungguPersetujuan }}</h2>
            <p>Menunggu Persetujuan</p>
        </div>
    </div>

</div>

<!-- GRAFIK -->
<div class="card" style="margin-top:24px">
    <h3 style="margin-bottom:12px">Grafik Laporan Bulanan</h3>
    <canvas id="laporanChart" height="100"></canvas>
</div>

<script>
const ctx = document.getElementById('laporanChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($bulan) !!},
        datasets: [{
            label: 'Jumlah Laporan',
            data: {!! json_encode($jumlah) !!},
            backgroundColor: '#6d5bff',
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

@endsection
