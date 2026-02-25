@extends('layouts.admin')

@section('content')

<div class="page-head">
    <div>
        <h2 class="page-title">Rekap Laporan</h2>
        <p class="page-subtitle">Riwayat laporan pegawai</p>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pegawai</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>
                        <span class="badge 
                            {{ $item->status == 'approved' ? 'badge-success' : 
                               ($item->status == 'pending' ? 'badge-warning' : 'badge-danger') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
