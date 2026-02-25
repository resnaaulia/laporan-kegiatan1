<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Laporan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = User::where('role', 'pegawai')->count();
        $totalLaporan = Laporan::count();
        $laporanHariIni = Laporan::whereDate('tanggal', today())->count();
        $menungguPersetujuan = Laporan::where('status', 'pending')->count();

        $bulan = [];
        $jumlah = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulan[] = Carbon::create()->month($i)->translatedFormat('F');
            $jumlah[] = Laporan::whereMonth('tanggal', $i)->count();
        }

        return view('admin.dashboard', compact(
            'totalPegawai',
            'totalLaporan',
            'laporanHariIni',
            'menungguPersetujuan',
            'bulan',
            'jumlah'
        ));
    }
}
