<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardPengunjungController;
use App\Http\Controllers\PemesananController;


/*
|--------------------------------------------------------------------------
| LANDING PAGE (Dashboard Pengunjung - Public)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardPengunjungController::class, 'index'])
    ->name('dashboard.pengunjung');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION (Login & Register)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD PENGELOLA (Harus Login)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard-pengelola', function () {

    if (Auth::user()->role != 'pengelola') {
        abort(403);
    }

    return view('pengelola.dashboard');
})->middleware('auth')->name('dashboard.pengelola');

Route::get('/admin/pemesanan', function () {
    return view('pengelola.pemesanan');
});

/*
|--------------------------------------------------------------------------
| FITUR PENGUNJUNG (Harus Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    | Pesan Tempat Kemah
    */
    Route::get('/pesan-tempat', [PemesananController::class, 'create'])
        ->name('pesan.tempat');

    Route::post('/pesan-tempat', [PemesananController::class, 'store'])
        ->name('pesan.tempat.store');


    /*
    | Riwayat Pemesanan (akan dipakai nanti)
    */
    Route::get('/riwayat-pemesanan', [PemesananController::class, 'index'])
        ->name('riwayat.pemesanan');
});
Route::get('/admin/pemesanan', [PemesananController::class, 'adminIndex'])
    ->middleware('auth')
    ->name('admin.pemesanan');

use App\Http\Controllers\DashboardPengelolaController;

Route::get('/dashboard-pengelola', [DashboardPengelolaController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard.pengelola');
Route::get('/admin/pemesanan/{id}/approve', [PemesananController::class, 'approve'])
    ->name('admin.approve');

Route::get('/admin/pemesanan/{id}/tolak', [PemesananController::class, 'tolak'])
    ->name('admin.tolak');

Route::get('/admin/pemesanan/{id}/checkin', [PemesananController::class, 'checkin'])
    ->name('admin.checkin');
Route::get('/admin/checkin', [PemesananController::class, 'formCheckin'])
    ->name('admin.form.checkin');

Route::post('/admin/checkin', [PemesananController::class, 'prosesCheckin'])
    ->name('admin.proses.checkin');
Route::get('/admin/jadwal', [PemesananController::class, 'jadwal'])
    ->name('admin.jadwal');
Route::get('/admin/pembayaran', [PemesananController::class, 'pembayaran'])
    ->name('admin.pembayaran');
Route::get(
    '/admin/generate-tiket/{id}',
    [PemesananController::class, 'generateTiket']
)->name('admin.generate.tiket');
Route::get('/tiket/{id}', function ($id) {
    $pemesanan = \App\Models\Pemesanan::findOrFail($id);
    return view('pengunjung.tiket', compact('pemesanan'));
});
Route::get('/admin/checkin', [PemesananController::class, 'formCheckin'])->name('admin.checkin.form');

Route::post('/admin/checkin/proses', [PemesananController::class, 'prosesCheckin'])->name('admin.prosesCheckin');

Route::get(
    '/admin/generate-tiket/{id}',
    [App\Http\Controllers\PemesananController::class, 'generateTiket']
)->name('admin.generate.tiket');

Route::get('/eticket', [DashboardPengunjungController::class, 'eticket'])
    ->name('pengunjung.eticket');
Route::get(
    '/admin/pembayaran/berhasil/{id}',
    [PemesananController::class, 'pembayaranBerhasil']
)->name('admin.pembayaran.berhasil');
Route::get(
    '/admin/pembayaran/berhasil/{id}',
    [App\Http\Controllers\PemesananController::class, 'pembayaranBerhasil']
)->name('admin.pembayaran.berhasil');
Route::get('/riwayat-pemesanan', [PemesananController::class, 'index'])
    ->middleware('auth')
    ->name('riwayat.pemesanan');

Route::get('/', function () {
    return view('pengunjung.dashboard');
})->name('home');
