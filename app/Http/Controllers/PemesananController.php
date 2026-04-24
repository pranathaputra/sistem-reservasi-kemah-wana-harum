<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    public function create()
    {
        return view('pengunjung.pesan_tempat');
    }
    /*
    |--------------------------------------------------------------------------
    | SIMPAN PEMESANAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'instansi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jumlah_laki' => 'required|integer',
            'jumlah_perempuan' => 'required|integer',
            'jumlah_pendamping' => 'nullable|integer'
        ]);

        // cek bentrok tanggal
        $bentrok = Pemesanan::where(function ($query) use ($request) {
            $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                ->orWhere(function ($q) use ($request) {
                    $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                        ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                });
        })->exists();

        if ($bentrok) {
            return back()->with('error', 'Tanggal sudah dibooking.');
        }

        // simpan pemesanan
        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'instansi' => $request->instansi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_laki' => $request->jumlah_laki,
            'jumlah_perempuan' => $request->jumlah_perempuan,
            'jumlah_pendamping' => $request->jumlah_pendamping,
            'status' => 'Pending',
            'status_pembayaran' => 'Pending',
            'status_checkin' => 'Belum',
            'kode_tiket' => null
        ]);

        // otomatis buat data pembayaran
        DB::table('payments')->insert([
            'pemesanan_id' => $pemesanan->id,
            'kode_pembayaran' => 'INV-' . strtoupper(Str::random(8)),
            'metode' => 'QRIS',
            'total' => 0,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/dashboard_pengunjung')
            ->with('success', 'Pemesanan berhasil!');
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DATA PEMESANAN
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $pemesanans = Pemesanan::latest()->get();

        return view('pengelola.pemesanan', compact('pemesanans'));
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE / TOLAK PEMESANAN
    |--------------------------------------------------------------------------
    */

    public function approve($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->status = 'disetujui';
        $pemesanan->save();

        return back();
    }


    public function tolak($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->status = 'ditolak';
        $pemesanan->save();

        return back();
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK-IN QR SCANNER
    |--------------------------------------------------------------------------
    */

    public function formCheckin()
    {
        return view('pengelola.checkin');
    }


    public function prosesCheckin(Request $request)
    {
        $request->validate([
            'kode_tiket' => 'required'
        ]);

        $pemesanan = Pemesanan::where('kode_tiket', $request->kode_tiket)->first();

        if (!$pemesanan) {
            return back()->with('error', 'Kode tiket tidak ditemukan');
        }

        if ($pemesanan->status_checkin == 'sudah') {
            return back()->with('error', 'Peserta sudah check-in sebelumnya');
        }

        $pemesanan->status_checkin = 'sudah';
        $pemesanan->save();

        return back()->with('success', 'Check-in berhasil');
    }


    /*
    |--------------------------------------------------------------------------
    | JADWAL KEMAH
    |--------------------------------------------------------------------------
    */

    public function jadwal()
    {
        $jadwals = Pemesanan::orderBy('tanggal_mulai', 'asc')->get();

        return view('pengelola.jadwal', compact('jadwals'));
    }


    /*
    |--------------------------------------------------------------------------
    | DATA PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function pembayaran()
    {
        $payments = DB::table('payments')
            ->join('pemesanans', 'payments.pemesanan_id', '=', 'pemesanans.id')
            ->select(
                'payments.*',
                'pemesanans.instansi',
                'pemesanans.tanggal_mulai',
                'pemesanans.tanggal_selesai'
            )
            ->orderBy('payments.created_at', 'desc')
            ->get();

        return view('pengelola.pembayaran', compact('payments'));
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE TIKET OTOMATIS SETELAH PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function generateTiketOtomatis($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if (!$pemesanan->kode_tiket) {

            $pemesanan->kode_tiket = 'TIKET-' . strtoupper(Str::random(8));
            $pemesanan->status_checkin = 'belum';
            $pemesanan->save();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SIMULASI PEMBAYARAN BERHASIL (SEBELUM MIDTRANS)
    |--------------------------------------------------------------------------
    */

    public function pembayaranBerhasil($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // update status di tabel pemesanans
        $pemesanan->status_pembayaran = 'berhasil';
        $pemesanan->save();

        // update tabel payments juga
        DB::table('payments')
            ->where('pemesanan_id', $id)
            ->update([
                'status' => 'berhasil',
                'updated_at' => now()
            ]);

        // generate tiket otomatis
        $this->generateTiketOtomatis($id);

        return back()->with('success', 'Pembayaran berhasil, tiket otomatis dibuat');
    }

    public function index()
    {
        $pemesanans = Pemesanan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pengunjung.riwayat', compact('pemesanans'));
    }
}
