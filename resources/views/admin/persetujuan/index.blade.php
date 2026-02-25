@extends('layouts.admin')

@section('content')

<div class="page-head">
    <div>
        <h2 class="page-title">Persetujuan Laporan</h2>
        <p class="page-subtitle">Laporan menunggu keputusan admin</p>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pegawai</th>
                    <th>Kegiatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($laporanPending as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->kegiatan }}</td>
                    <td>
                        <span class="badge badge-warning">Pending</span>
                    </td>
                    <td class="actions">
                        <form method="POST" action="{{ route('admin.persetujuan.approve', $item->id) }}">
                            @csrf
                            <button class="btn-success">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.persetujuan.reject', $item->id) }}">
                            @csrf
                            <button class="btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty">Tidak ada laporan pending</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
