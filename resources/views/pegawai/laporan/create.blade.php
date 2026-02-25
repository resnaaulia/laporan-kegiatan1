@extends('layouts.pegawai')

@section('content')

<div class="page-head">
    <div>
        <h2 class="page-title">Buat Laporan Kegiatan</h2>
        <p class="page-subtitle">Isi laporan kegiatan harian Anda</p>
    </div>
</div>

<div class="card form-card">
    <form action="{{ route('pegawai.laporan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" required>
            </div>

            <div class="form-group">
                <label>Kegiatan</label>
                <textarea name="kegiatan" rows="3" placeholder="Tuliskan kegiatan..." required></textarea>
            </div>

            <div class="form-group">
                <label>Keterangan (opsional)</label>
                <textarea name="keterangan" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label>Upload File (opsional)</label>
                <input type="file" name="file">
            </div>
        </div>

        <div class="form-action">
            <button class="btn-primary">Kirim Laporan</button>
            <a href="{{ route('pegawai.dashboard') }}" class="btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection
