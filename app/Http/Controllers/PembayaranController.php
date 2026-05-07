<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    public function proses($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->status_pembayaran = 'lunas';
        $pemesanan->status = 'disetujui';

        $pemesanan->kode_tiket = 'TIKET-' . strtoupper(Str::random(8));

        // expired = tanggal selesai kemah
        $pemesanan->expired_at = $pemesanan->tanggal_selesai;

        $pemesanan->save();

        return redirect()->route('riwayat.pemesanan')
            ->with('success', 'Pembayaran berhasil!');
    }

    public function berhasil($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->status_pembayaran = 'lunas';

        $pemesanan->expired_at = $pemesanan->tanggal_selesai;

        $pemesanan->save();
        $pemesanan->status = 'disetujui';
        $pemesanan->kode_tiket = 'TIKET-' . strtoupper(Str::random(8));

        $pemesanan->save();

        return redirect()->route('riwayat.pemesanan')
            ->with('success', 'Pembayaran berhasil!');
    }
}
