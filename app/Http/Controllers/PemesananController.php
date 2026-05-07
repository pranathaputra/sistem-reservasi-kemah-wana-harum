<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            return back()
                ->withInput()
                ->with('error', 'Tanggal tersebut sudah dibooking. Silakan pilih tanggal lain.');
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
            'status' => 'pending',
            'status_pembayaran' => 'pending',
            'status_checkin' => 'belum',
            'kode_tiket' => null,
            'expired_at' => now()->addHours(3),
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

        return redirect()->route('pembayaran.proses', $pemesanan->id);
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
    | CHECK-IN QR SCANNER
    |--------------------------------------------------------------------------
    */

    public function formCheckin()
    {
        $totalHadir = Pemesanan::where('status_checkin', 'hadir')
            ->whereDate('checked_in_at', today())
            ->count();

        return view('pengelola.checkin', compact('totalHadir'));
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
        $pemesanan->status = 'Digunakan'; // 🔥 tambahan
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
            $pemesanan->status_checkin = 'Belum';
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

        // update status pemesanan
        $pemesanan->status_pembayaran = 'berhasil';
        $pemesanan->status = 'pending'; // 🔥 penting
        $pemesanan->save();

        // update tabel payments
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

        foreach ($pemesanans as $item) {

            /** @var \App\Models\Pemesanan $item */

            if (
                $item->status_pembayaran == 'pending' &&
                now()->gt($item->expired_at)
            ) {
                $item->status_pembayaran = 'expired';
                $item->save();
            }

            if (
                $item->status_pembayaran == 'berhasil' &&
                Carbon::today()->between($item->tanggal_mulai, $item->tanggal_selesai)
            ) {
                $item->status = 'Aktif';
                $item->save();
            }

            if (
                Carbon::today()->gt($item->tanggal_selesai) &&
                $item->status != 'Digunakan'
            ) {
                $item->status = 'Expired';
                $item->save();
            }
        }

        return view('pengunjung.riwayat', compact('pemesanans'));
    }

    public function eticketUser()
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())
            ->where('status_pembayaran', 'lunas')
            ->latest()
            ->first();

        if (!$pemesanan) {
            return redirect()->route('riwayat.pemesanan')
                ->with('error', 'Belum ada tiket aktif.');
        }

        return view('pengunjung.eticket', compact('pemesanan'));
    }
}
