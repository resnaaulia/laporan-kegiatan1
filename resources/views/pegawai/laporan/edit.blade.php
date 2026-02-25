@extends('layouts.pegawai')

@section('content')

<div class="page-head mb-4">
    <div>
        <h2 class="page-title">Edit Laporan</h2>
        <p class="page-subtitle">Perbarui data laporan kegiatan</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('pegawai.laporan.update', $laporan->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- TANGGAL --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="{{ $laporan->tanggal }}"
                       required>
            </div>

            {{-- KEGIATAN --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Kegiatan</label>
                <textarea name="kegiatan"
                          rows="4"
                          class="form-control"
                          required>{{ $laporan->kegiatan }}</textarea>
            </div>

            {{-- FILE --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">File Laporan</label>
                <input type="file"
                       name="file"
                       class="form-control">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti file
                </small>
            </div>

            {{-- TOMBOL --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('pegawai.laporan.index') }}"
                   class="btn btn-secondary">
                    ⬅ Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    💾 Simpan Perubahan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection