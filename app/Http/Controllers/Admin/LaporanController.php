<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index()
    {
        // ADMIN LIHAT SEMUA LAPORAN
        $laporan = Laporan::with('user')
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);

        return view('admin.laporan.show', compact('laporan'));
    }
}
