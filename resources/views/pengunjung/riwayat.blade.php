@extends('layouts.pengunjung')

@section('content')

<div class="riwayat-wrapper">

    <h2 class="riwayat-title">
        Riwayat Pemesanan Anda
    </h2>

    @if($pemesanans->count() > 0)

    @foreach($pemesanans as $pemesanan)

    <div class="riwayat-card">

        <div class="riwayat-row">

            <!-- INSTANSI -->
            <div class="riwayat-item">
                <label>Instansi</label>
                <span>{{ $pemesanan->instansi }}</span>
            </div>

            <!-- TANGGAL -->
            <div class="riwayat-item">
                <label>Tanggal</label>
                <span>
                    {{ $pemesanan->tanggal_mulai }}
                    -
                    {{ $pemesanan->tanggal_selesai }}
                </span>
            </div>

            <!-- TOTAL PESERTA -->
            <div class="riwayat-item">
                <label>Total Peserta</label>
                <span>
                    {{ $pemesanan->jumlah_laki
                        + $pemesanan->jumlah_perempuan
                        + $pemesanan->jumlah_pendamping }}
                </span>
            </div>

            <!-- STATUS PEMBAYARAN -->
            <div class="riwayat-item">
                <label>Status Pembayaran</label>

                @if($pemesanan->status_pembayaran == 'lunas')

                <span class="badge bg-success">
                    Lunas
                </span>

                @elseif($pemesanan->status_pembayaran == 'expired')

                <span class="badge bg-danger">
                    Expired
                </span>

                @else

                <span class="badge bg-warning">
                    Pending
                </span>

                @endif

            </div>

            <!-- STATUS TIKET -->
            <div class="riwayat-item">
                <label>Status Tiket</label>

                @if($pemesanan->status_pembayaran == 'lunas')

                <span class="badge bg-success">
                    Aktif
                </span>

                @else

                <span class="badge bg-secondary">
                    Belum tersedia
                </span>

                @endif

            </div>

            <!-- AKSI -->
            <div class="riwayat-action">

                @if($pemesanan->status_pembayaran == 'pending')

                <a href="{{ route('pembayaran.proses', $pemesanan->id) }}"
                    class="btn-bayar">
                    Bayar Sekarang
                </a>

                @elseif($pemesanan->status_pembayaran == 'lunas')

                @if($pemesanan->id)
                <a href="{{ route('pengunjung.eticket', $pemesanan->id) }}" class="btn-lihat">
                    Lihat Tiket
                </a>
                @endif

                @endif

            </div>

        </div>

    </div>

    @endforeach

    @else

    <div class="alert-box">
        Belum ada riwayat pemesanan.
    </div>

    @endif

</div>


<style>
    .riwayat-wrapper {
        max-width: 1100px;
        margin: 80px auto;
        padding: 0 20px;
    }

    .riwayat-title {
        margin-bottom: 30px;
        font-weight: 600;
    }

    .riwayat-card {
        background: white;
        padding: 25px 30px;
        border-radius: 18px;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .riwayat-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        align-items: center;
    }

    .riwayat-item label {
        display: block;
        font-size: 13px;
        color: #888;
        margin-bottom: 4px;
    }

    .riwayat-item span {
        font-weight: 500;
    }

    .btn-lihat {
        padding: 8px 16px;
        background: #2d7ef7;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-lihat:hover {
        background: #1f5fd1;
    }

    .btn-bayar {
        padding: 8px 16px;
        background: #f39c12;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-bayar:hover {
        background: #d68910;
    }

    .alert-box {
        background: #eef5ff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        color: #444;
    }

    @media(max-width:768px) {

        .riwayat-card {
            padding: 20px;
        }

        .riwayat-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .btn-lihat {
            width: 100%;
            text-align: center;
        }

    }
</style>

@endsection