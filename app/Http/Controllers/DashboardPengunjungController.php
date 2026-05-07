<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use App\Models\Fasilitas;
use App\Models\Kegiatan;

class DashboardPengunjungController extends Controller
{


    public function index()
    {
        $bookings = Pemesanan::select('tanggal_mulai', 'tanggal_selesai')
            ->where('status_pembayaran', '!=', 'expired')
            ->orderBy('tanggal_mulai', 'asc')
            ->get();

        $fasilitas = Fasilitas::all();
        $kegiatan = Kegiatan::all();
        return view('pengunjung.dashboard', compact('bookings', 'fasilitas'));
    }
    public function eticket()
    {
        $pemesanan = \App\Models\Pemesanan::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->latest()
            ->first();

        return view('pengunjung.eticket', compact('pemesanan'));
    }
}
