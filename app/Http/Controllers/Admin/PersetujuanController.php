<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    public function index()
    {
        $laporanPending = Laporan::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.persetujuan.index', compact('laporanPending'));
    }

    public function approve($id)
    {
        Laporan::findOrFail($id)->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Laporan disetujui ✅');
    }

    public function reject($id)
    {
        Laporan::findOrFail($id)->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Laporan ditolak ❌');
    }
}
