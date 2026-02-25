<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;

class RekapController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with('user')
            ->latest()
            ->get();

        return view('admin.rekap.index', compact('laporan'));
    }
}
