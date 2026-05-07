@extends('layouts.pengunjung')

@php
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

@section('content')

<div class="ticket-wrapper">

    @if($pemesanan && $pemesanan->kode_tiket)

    @php
    $statusTiket = 'Aktif';

    if($pemesanan->status_checkin == 'hadir'){
    $statusTiket = 'Sudah Digunakan';
    }
    elseif($pemesanan->expired_at && now()->gt($pemesanan->expired_at)){
    $statusTiket = 'Expired';
    }
    @endphp


    <div class="ticket-card">

        <h2 class="ticket-title">
            E-Ticket Reservasi
        </h2>


        <div class="ticket-section">

            <div class="ticket-row">
                <div>
                    <label>Instansi</label>
                    <p>{{ $pemesanan->instansi }}</p>
                </div>

                <div>
                    <label>Kode Tiket</label>
                    <p>{{ $pemesanan->kode_tiket }}</p>
                </div>
            </div>


            <div class="ticket-row">
                <div>
                    <label>Tanggal Mulai</label>
                    <p>{{ $pemesanan->tanggal_mulai }}</p>
                </div>

                <div>
                    <label>Tanggal Selesai</label>
                    <p>{{ $pemesanan->tanggal_selesai }}</p>
                </div>
            </div>


            <div class="ticket-row">
                <div>
                    <label>Total Peserta</label>
                    <p>
                        {{ $pemesanan->jumlah_laki
+ $pemesanan->jumlah_perempuan
+ $pemesanan->jumlah_pendamping }}
                    </p>
                </div>

                <div>
                    <label>Status Tiket</label>

                    @if($statusTiket == 'Aktif')
                    <p class="status-active">Aktif</p>

                    @elseif($statusTiket == 'Expired')
                    <p class="status-expired">Expired</p>

                    @else
                    <p class="status-used">Sudah Digunakan</p>
                    @endif

                </div>
            </div>

        </div>


        <div class="ticket-row">
            <div>
                <label>Berlaku Sampai</label>

                @if($pemesanan->expired_at)
                <p>{{ Carbon::parse($pemesanan->expired_at)->format('d M Y') }}</p>
                @else
                <p>-</p>
                @endif

            </div>

            <div>
                <label>Status Check-in</label>

                @if($pemesanan->status_checkin == 'hadir')
                <p class="status-used">Sudah Check-in</p>
                @else
                <p class="status-active">Belum Check-in</p>
                @endif

            </div>
        </div>


        <div class="qr-area">

            {!! QrCode::size(200)->generate($pemesanan->kode_tiket) !!}

            <small>
                Tunjukkan QR code ini saat check-in
            </small>

        </div>


        <div class="ticket-actions">

            <a href="{{ route('riwayat.pemesanan') }}"
                class="btn-cancel">
                Kembali
            </a>

            <button onclick="window.print()"
                class="btn-download">
                Download
            </button>

        </div>

    </div>

    @else

    <div class="ticket-empty">
        Tiket belum tersedia. Silakan tunggu konfirmasi admin.
    </div>

    @endif

</div>


<style>
    .ticket-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
    }

    .ticket-card {
        background: white;
        width: 420px;
        max-width: 100%;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .ticket-title {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
    }

    .ticket-section {
        border-bottom: 1px dashed #ddd;
        padding-bottom: 20px;
        margin-bottom: 25px;
    }

    .ticket-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .ticket-row label {
        font-size: 12px;
        color: #888;
    }

    .ticket-row p {
        margin: 0;
        font-weight: 500;
    }

    .status-active {
        color: #28a745;
        font-weight: 600;
    }

    .status-expired {
        color: #dc3545;
        font-weight: 600;
    }

    .status-used {
        color: #6c757d;
        font-weight: 600;
    }

    .qr-area {
        text-align: center;
        margin-top: 10px;
    }

    .qr-area small {
        display: block;
        margin-top: 10px;
        color: #777;
    }

    .ticket-actions {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-cancel {
        flex: 1;
        padding: 12px;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        border: 1px solid #ccc;
        color: #333;
    }

    .btn-download {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: #2f2f4f;
        color: white;
        cursor: pointer;
    }


    @media print {

        .header,
        .sidebar,
        nav,
        footer,
        .ticket-actions {
            display: none !important;
        }

        body {
            margin: 0;
        }

        .ticket-wrapper {
            padding: 0;
        }

        .ticket-card {
            width: 100%;
            max-width: 500px;
            margin: auto;
            box-shadow: none;
            border: 1px solid #ddd;
            page-break-inside: avoid;
        }

        .qr-area svg {
            width: 160px !important;
            height: 160px !important;
        }

    }
</style>

@endsection