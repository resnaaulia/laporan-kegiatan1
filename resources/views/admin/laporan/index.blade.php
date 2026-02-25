@extends('layouts.admin')

@section('content')

<div class="page-head">
    <div>
        <h2 class="page-title">Data Laporan</h2>
        <p class="page-subtitle">Seluruh laporan pegawai</p>
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
                    <th>Kegiatan</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->kegiatan }}</td>
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
                    <td colspan="5" class="empty">Belum ada laporan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
