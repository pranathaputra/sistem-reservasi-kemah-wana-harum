@extends('layouts.pengunjung')
@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp
@section('content')

<div class="ticket-wrapper">

    @if($pemesanan && $pemesanan->kode_tiket)

    <div class="ticket-card">

        <h2 class="ticket-title">
            Reservation Details
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
                    <label>Status</label>
                    <p class="status-active">
                        Aktif
                    </p>
                </div>
            </div>

        </div>


        <div class="qr-area">

            {!! QrCode::size(200)->generate($pemesanan->kode_tiket) !!}

            <small>
                Tunjukkan QR code ini saat check-in
            </small>

        </div>


        <div class="ticket-actions">

            <a href="{{ route('dashboard.pengunjung') }}"
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

        Tiket belum tersedia.
        Silakan tunggu konfirmasi admin.

    </div>

    @endif

</div>


<style>
    /* WRAPPER */

    .ticket-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
    }


    /* CARD */

    .ticket-card {

        background: white;
        width: 420px;
        max-width: 100%;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);

    }


    /* TITLE */

    .ticket-title {

        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;

    }


    /* SECTION */

    .ticket-section {

        border-bottom: 1px dashed #ddd;
        padding-bottom: 20px;
        margin-bottom: 25px;

    }


    /* ROW */

    .ticket-row {

        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;

    }


    /* LABEL */

    .ticket-row label {

        font-size: 12px;
        color: #888;

    }


    /* VALUE */

    .ticket-row p {

        margin: 0;
        font-weight: 500;

    }


    /* STATUS */

    .status-active {

        color: #28a745;
        font-weight: 600;

    }


    /* QR AREA */

    .qr-area {

        text-align: center;
        margin-top: 10px;

    }

    .qr-area small {

        display: block;
        margin-top: 10px;
        color: #777;

    }


    /* BUTTON AREA */

    .ticket-actions {

        display: flex;
        gap: 12px;
        margin-top: 25px;

    }


    /* BUTTON CANCEL */

    .btn-cancel {

        flex: 1;
        padding: 12px;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        border: 1px solid #ccc;
        color: #333;

    }


    /* BUTTON DOWNLOAD */

    .btn-download {

        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: #2f2f4f;
        color: white;
        cursor: pointer;

    }


    /* MOBILE */

    @media(max-width:768px) {

        .ticket-card {

            padding: 25px;

        }

        .ticket-row {

            flex-direction: column;
            gap: 6px;

        }

        .ticket-actions {

            flex-direction: column;

        }

        @media print {

            /* sembunyikan header layout */
            .header,
            .sidebar,
            nav,
            footer,
            .ticket-actions {
                display: none !important;
            }

            /* hilangkan margin halaman */
            body {
                margin: 0;
            }

            /* card jadi full tengah */
            .ticket-wrapper {
                padding: 0;
            }

            /* ukuran card fix supaya muat 1 halaman */
            .ticket-card {
                width: 100%;
                max-width: 500px;
                margin: auto;
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }

            /* kecilkan QR sedikit supaya muat */
            .qr-area svg {
                width: 160px !important;
                height: 160px !important;
            }

        }
    }
</style>

@endsection