@extends('layouts.pegawai')

@section('content')

<div class="page-head mb-4">
    <div>
        <h2 class="page-title">Riwayat Laporan</h2>
        <p class="page-subtitle">Daftar laporan yang telah Anda kirim</p>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="table-modern">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th style="width: 130px;">Tanggal</th>
                    <th>Kegiatan</th>
                    <th style="width: 160px;">Status</th>
                    <th style="width: 120px;">File</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>

                    <td>{{ $item->kegiatan }}</td>

                    {{-- STATUS --}}
                    <td>
                        <span class="badge bg-success text-white">
                        Approved
                    </span>
                    </td>

                    {{-- FILE --}}
                    <td>
                        @if ($item->file)
                            <a href="{{ route('pegawai.laporan.file', $item->id) }}"
                               target="_blank">
                                Lihat
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td>
                        @if ($item->status == 'pending')
                            <div class="d-flex gap-2">
                                <a href="{{ route('pegawai.laporan.edit', $item->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('pegawai.laporan.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin mau hapus laporan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted fst-italic">
                                Tidak bisa diubah
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada laporan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection