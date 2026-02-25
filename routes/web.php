<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PegawaiController as AdminPegawai;
use App\Http\Controllers\Admin\LaporanController as AdminLaporan;
use App\Http\Controllers\Admin\PersetujuanController as AdminPersetujuan;
use App\Http\Controllers\Admin\RekapController as AdminRekap;

/*
|--------------------------------------------------------------------------
| PEGAWAI CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboard;
use App\Http\Controllers\Pegawai\LaporanController as PegawaiLaporan;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'loginProcess'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ROOT / HOME REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('pegawai.dashboard');
    }

    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        // =====================
        // DATA PEGAWAI
        // =====================
        Route::get('/pegawai', [AdminPegawai::class, 'index'])
            ->name('pegawai.index');

        Route::post('/pegawai', [AdminPegawai::class, 'store'])
            ->name('pegawai.store');

        Route::put('/pegawai/{user}', [AdminPegawai::class, 'update'])
            ->name('pegawai.update');

        Route::delete('/pegawai/{user}', [AdminPegawai::class, 'destroy'])
            ->name('pegawai.destroy');

        // =====================
        // LAPORAN
        // =====================
        Route::get('/laporan', [AdminLaporan::class, 'index'])
            ->name('laporan.index');

        Route::get('/laporan/{laporan}', [AdminLaporan::class, 'show'])
            ->name('laporan.show');

        // =====================
        // PERSETUJUAN
        // =====================
        Route::get('/persetujuan', [AdminPersetujuan::class, 'index'])
            ->name('persetujuan.index');

        Route::post('/persetujuan/{id}/approve', [AdminPersetujuan::class, 'approve'])
             ->name('persetujuan.approve');

        Route::post('/persetujuan/{id}/reject', [AdminPersetujuan::class, 'reject'])
             ->name('persetujuan.reject');

        Route::post('/persetujuan/{id}/reject-note', [AdminPersetujuan::class, 'rejectWithNote'])
             ->name('persetujuan.reject.note');

             
        // =====================
        // REKAP
        // =====================
        Route::get('/rekap', [AdminRekap::class, 'index'])
            ->name('rekap.index');
    });

/*
|--------------------------------------------------------------------------
| PEGAWAI ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->name('pegawai.')
    ->group(function () {

        Route::get('/dashboard', [PegawaiDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/laporan/buat', [PegawaiLaporan::class, 'create'])
            ->name('laporan.create');

        Route::post('/laporan/buat', [PegawaiLaporan::class, 'store'])
            ->name('laporan.store');

        Route::get('/laporan/riwayat', [PegawaiLaporan::class, 'index'])
            ->name('laporan.index');

        Route::get('/laporan/{id}/edit', [PegawaiLaporan::class, 'edit'])
            ->name('laporan.edit');

        Route::put('/laporan/{id}', [PegawaiLaporan::class, 'update'])
            ->name('laporan.update');

        Route::delete('/laporan/{id}', [PegawaiLaporan::class, 'destroy'])
            ->name('laporan.destroy');

        // 🔥 INI WAJIB ADA
        Route::get('/laporan/file/{id}', [PegawaiLaporan::class, 'file'])
            ->name('laporan.file');
});