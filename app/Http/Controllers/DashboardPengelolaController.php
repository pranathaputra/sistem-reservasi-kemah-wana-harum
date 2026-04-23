<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class DashboardPengelolaController extends Controller
{
    public function index()
    {
        $totalPemesanan = Pemesanan::count();

        $pemesananHariIni = Pemesanan::whereDate('created_at', today())->count();

        $pembayaranBerhasil = Pemesanan::where('status_pembayaran', 'berhasil')->count();

        $sudahCheckin = Pemesanan::where('status_checkin', 'sudah')->count();

        $pending = Pemesanan::where('status', 'pending')->count();

        $belumBayar = Pemesanan::where('status_pembayaran', 'pending')->count();

        $pemesananTerbaru = Pemesanan::latest()->take(5)->get();

        return view('pengelola.dashboard', compact(
            'totalPemesanan',
            'pending',
            'sudahCheckin',
            'belumBayar',
            'pemesananTerbaru'
        ));
    }
}
