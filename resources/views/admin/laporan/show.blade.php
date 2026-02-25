@extends('layouts.admin')

@section('content')
<h1 style="font-size: 34px; font-weight: 800; margin-bottom: 6px;">Detail Laporan</h1>
<p style="margin-top:0; color:#333;">Lihat detail laporan kegiatan pegawai.</p>

<div style="background:#fff; padding:20px; border-radius:16px; box-shadow:0 10px 25px rgba(0,0,0,0.08); max-width:800px;">
    <p><b>Pegawai:</b> {{ $laporan->user->name ?? '-' }} ({{ $laporan->user->email ?? '-' }})</p>
    <p><b>Tanggal:</b> {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</p>
    <p><b>Status:</b> {{ strtoupper($laporan->status) }}</p>

    <hr style="margin:16px 0;">

    <p><b>Kegiatan:</b></p>
    <div style="padding:12px; background:#f9fafb; border-radius:12px;">
        {{ $laporan->kegiatan }}
    </div>

    <p style="margin-top:14px;"><b>Keterangan:</b></p>
    <div style="padding:12px; background:#f9fafb; border-radius:12px;">
        {{ $laporan->keterangan ?? '-' }}
    </div>

    <p style="margin-top:14px;"><b>File:</b>
        @if($laporan->file)
            <a href="{{ asset('storage/'.$laporan->file) }}" target="_blank">Lihat File</a>
        @else
            -
        @endif
    </p>

    <div style="margin-top:18px;">
        <a href="{{ route('admin.laporan.index') }}"
           style="background:#e5e7eb; color:#111827; padding:10px 14px; border-radius:12px; text-decoration:none; font-weight:700;">
            Kembali
        </a>
    </div>
</div>
@endsection
