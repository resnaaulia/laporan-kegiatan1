<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // CARD DATA
        $totalLaporan     = Laporan::where('user_id', $userId)->count();
        $laporanDisetujui = Laporan::where('user_id', $userId)->where('status', 'approved')->count();
        $laporanPending   = Laporan::where('user_id', $userId)->where('status', 'pending')->count();
        $laporanDitolak   = Laporan::where('user_id', $userId)->where('status', 'rejected')->count();

        // 🔥 DATA GRAFIK (PER TANGGAL)
        $grafikLaporan = Laporan::select(
                DB::raw('DATE(tanggal) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('user_id', $userId)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('pegawai.dashboard', compact(
            'totalLaporan',
            'laporanDisetujui',
            'laporanPending',
            'laporanDitolak',
            'grafikLaporan'
        ));
    }
}
