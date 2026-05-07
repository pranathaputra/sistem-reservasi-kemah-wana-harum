<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;

class CheckinController extends Controller
{
    
public function proses(Request $request)
    {
        $pemesanan = \App\Models\Pemesanan::where(
            'kode_tiket',
            $request->kode_tiket
        )->first();

        if (!$pemesanan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode tiket tidak ditemukan'
            ]);
        }

        // validasi tanggal belum mulai
        if (now()->lt($pemesanan->tanggal_mulai)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket belum bisa digunakan hari ini'
            ]);
        }

        // validasi expired
        if (
            $pemesanan->expired_at &&
            now()->gt($pemesanan->expired_at)
        ) {

            return response()->json([
                'status' => 'error',
                'message' => 'Tiket sudah expired'
            ]);
        }

        // validasi sudah digunakan
        if ($pemesanan->status_checkin == 'hadir') {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket sudah digunakan sebelumnya'
            ]);
        }

        // update check-in
        $pemesanan->status_checkin = 'hadir';
        $pemesanan->checked_in_at = now();
        $pemesanan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Check-in berhasil: ' . $pemesanan->instansi,
            'instansi' => $pemesanan->instansi,
            'waktu' => $pemesanan->checked_in_at->format('H:i:s')
        ]);
    }
}
