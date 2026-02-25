<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * Menampilkan riwayat laporan pegawai
     */
    public function index()
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pegawai.laporan.index', compact('laporan'));
    }

    /**
     * Menampilkan form buat laporan
     */
    public function create()
    {
        return view('pegawai.laporan.create');
    }

    /**
     * Menyimpan laporan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'kegiatan'   => 'required|string',
            'keterangan' => 'nullable|string',
            'file'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            // hasil: laporan/namafile.ext
            $filePath = $request->file('file')->store('laporan', 'public');
        }

        Laporan::create([
            'user_id'    => Auth::id(),
            'tanggal'    => $request->tanggal,
            'kegiatan'   => $request->kegiatan,
            'keterangan' => $request->keterangan,
            'file'       => $filePath,
            'status'     => 'pending',
        ]);

        return redirect()
            ->route('pegawai.laporan.index')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Menampilkan form edit laporan
     */
    public function edit($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pegawai.laporan.edit', compact('laporan'));
    }

    /**
     * Memperbarui laporan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'kegiatan'   => 'required|string',
            'keterangan' => 'nullable|string',
            'file'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $laporan = Laporan::where('user_id', Auth::id())
            ->findOrFail($id);

        $filePath = $laporan->file;

        if ($request->hasFile('file')) {
            if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
                Storage::disk('public')->delete($laporan->file);
            }

            $filePath = $request->file('file')->store('laporan', 'public');
        }

        $laporan->update([
            'tanggal'    => $request->tanggal,
            'kegiatan'   => $request->kegiatan,
            'keterangan' => $request->keterangan,
            'file'       => $filePath,
        ]);

        return redirect()
            ->route('pegawai.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui!');
    }

    /**
     * Menghapus laporan
     */
    public function destroy($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
            Storage::disk('public')->delete($laporan->file);
        }

        $laporan->delete();

        return redirect()
            ->route('pegawai.laporan.index')
            ->with('success', 'Laporan berhasil dihapus!');
    }

    /**
     * ===============================
     * 🔥 INI KUNCI UTAMA (ANTI 404)
     * ===============================
     * Menampilkan / download file laporan
     */
    public function file($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->findOrFail($id);

        if (!$laporan->file || !Storage::disk('public')->exists($laporan->file)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->response($laporan->file);
    }
}