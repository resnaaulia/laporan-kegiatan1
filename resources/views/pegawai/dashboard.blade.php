@extends('layouts.pegawai')

@section('title', 'Dashboard Pegawai')

@section('content')

<div class="page-head">
    <div>
        <h2 class="page-title">Dashboard Pegawai</h2>
        <p class="page-subtitle">Ringkasan aktivitas laporan kamu</p>
    </div>
</div>

<!-- CARD RINGKASAN -->
<div class="dashboard-cards">

    <div class="stat-card blue">
        <i class="fa-solid fa-file-lines"></i>
        <div>
            <h2>{{ $totalLaporan }}</h2>
            <p>Total Laporan</p>
        </div>
    </div>

    <div class="stat-card green">
        <i class="fa-solid fa-check-circle"></i>
        <div>
            <h2>{{ $laporanDisetujui }}</h2>
            <p>Laporan Disetujui</p>
        </div>
    </div>

    <div class="stat-card orange">
        <i class="fa-solid fa-clock"></i>
        <div>
            <h2>{{ $laporanPending }}</h2>
            <p>Menunggu Persetujuan</p>
        </div>
    </div>

    <div class="stat-card red">
        <i class="fa-solid fa-xmark-circle"></i>
        <div>
            <h2>{{ $laporanDitolak }}</h2>
            <p>Laporan Ditolak</p>
        </div>
    </div>

</div>

<!-- GRAFIK -->
<div class="card" style="margin-top: 30px;">
    <h3 style="margin-bottom: 15px;">Grafik Laporan Terkirim</h3>
    <canvas id="laporanChart" height="100"></canvas>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = {!! json_encode($grafikLaporan->pluck('tanggal')) !!};
    const data = {!! json_encode($grafikLaporan->pluck('total')) !!};

    const ctx = document.getElementById('laporanChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Laporan',
                data: data,
                borderWidth: 2,
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
