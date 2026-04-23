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

            <div class="riwayat-item">
                <label>Instansi</label>
                <span>{{ $pemesanan->instansi }}</span>
            </div>

            <div class="riwayat-item">
                <label>Tanggal</label>
                <span>
                    {{ $pemesanan->tanggal_mulai }}
                    -
                    {{ $pemesanan->tanggal_selesai }}
                </span>
            </div>

            <div class="riwayat-item">
                <label>Total Peserta</label>
                <span>
                    {{ $pemesanan->jumlah_laki
                        + $pemesanan->jumlah_perempuan
                        + $pemesanan->jumlah_pendamping }}
                </span>
            </div>

            <div class="riwayat-item">

                <label>Status Pembayaran</label>

                @if($pemesanan->status_pembayaran == 'berhasil')

                <span class="badge bg-success">
                    Lunas
                </span>

                @else

                <span class="badge bg-warning">
                    Pending
                </span>

                @endif

            </div>


            <div class="riwayat-item">

                <label>Status Tiket</label>

                @if($pemesanan->kode_tiket)

                <span class="badge bg-success">
                    Aktif
                </span>

                @else

                <span class="badge bg-secondary">
                    Belum tersedia
                </span>

                @endif

            </div>


            <div class="riwayat-action">

                @if($pemesanan->kode_tiket)

                <a href="{{ route('pengunjung.eticket') }}"
                    class="btn-lihat">

                    Lihat Tiket

                </a>

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
    /* WRAPPER */

    .riwayat-wrapper {
        max-width: 1100px;
        margin: 80px auto;
        padding: 0 20px;
    }

    /* TITLE */

    .riwayat-title {
        margin-bottom: 30px;
        font-weight: 600;
    }

    /* CARD */

    .riwayat-card {
        background: white;
        padding: 25px 30px;
        border-radius: 18px;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    /* ROW GRID */

    .riwayat-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        align-items: center;
    }

    /* ITEM */

    .riwayat-item label {
        display: block;
        font-size: 13px;
        color: #888;
        margin-bottom: 4px;
    }

    .riwayat-item span {
        font-weight: 500;
    }

    /* BUTTON */

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

    /* ALERT */

    .alert-box {
        background: #eef5ff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        color: #444;
    }

    /* MOBILE */

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