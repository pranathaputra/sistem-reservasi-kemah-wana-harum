<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class DashboardPengunjungController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->latest()
            ->first();

        return view('pengunjung.dashboard', compact('pemesanan'));
    }

    public function eticket()
    {
        $pemesanan = \App\Models\Pemesanan::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->latest()
            ->first();

        return view('pengunjung.eticket', compact('pemesanan'));
    }
}
