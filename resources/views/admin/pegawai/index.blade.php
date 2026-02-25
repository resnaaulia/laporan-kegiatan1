@extends('layouts.admin')

@section('content')

<div class="pegawai-page">

    <div class="page-head">
        <div>
            <h2 class="page-title">Data Pegawai</h2>
            <p class="page-subtitle">Daftar seluruh pegawai terdaftar</p>
        </div>
    </div>

    <div class="card pegawai-card">
        <div class="table-wrap">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pegawai as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <div class="namecell">
                                <div class="avatar">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="name">{{ $item->name }}</div>
                                    <div class="muted">{{ $item->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $item->email }}</td>

                        <td>
                            <span class="badge">Pegawai</span>
                        </td>

                        <td>
                            <form method="POST" action="#">
                                @csrf
                                <button type="submit" class="btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada data pegawai
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
