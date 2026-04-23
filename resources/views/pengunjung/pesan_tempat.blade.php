@extends('layouts.pengunjung')

@section('content')

<div class="booking-wrapper">

    <div class="booking-card">

        <h2 class="booking-title">Form Pemesanan Tempat Kemah</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form action="{{ route('pesan.tempat.store') }}" method="POST">
            @csrf

            <div class="row">

                <!-- INSTANSI -->
                <div class="col-md-6 mb-3">
                    <label>Nama Instansi</label>
                    <input type="text"
                        name="instansi"
                        class="form-control"
                        required>
                </div>

                <!-- PENDAMPING -->
                <div class="col-md-6 mb-3">
                    <label>Jumlah Pendamping</label>
                    <input type="number"
                        name="jumlah_pendamping"
                        class="form-control"
                        min="0">
                </div>

                <!-- TANGGAL MULAI -->
                <div class="col-md-6 mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date"
                        name="tanggal_mulai"
                        class="form-control"
                        required>
                </div>

                <!-- TANGGAL SELESAI -->
                <div class="col-md-6 mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date"
                        name="tanggal_selesai"
                        class="form-control"
                        required>
                </div>

                <!-- LAKI -->
                <div class="col-md-6 mb-3">
                    <label>Peserta Laki-laki</label>
                    <input type="number"
                        name="jumlah_laki"
                        class="form-control"
                        min="0"
                        required>
                </div>

                <!-- PEREMPUAN -->
                <div class="col-md-6 mb-3">
                    <label>Peserta Perempuan</label>
                    <input type="number"
                        name="jumlah_perempuan"
                        class="form-control"
                        min="0"
                        required>
                </div>

                <!-- TOTAL AUTO -->
                <div class="col-12 mb-3">
                    <label>Total Peserta</label>
                    <input type="text"
                        id="totalPeserta"
                        class="form-control"
                        readonly>
                </div>

            </div>

            <button type="submit" class="btn-submit">
                Pesan Sekarang
            </button>

        </form>

    </div>

</div>


<style>
    /* WRAPPER */

    .booking-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 90px;
        margin-bottom: 60px;
    }

    /* CARD */

    .booking-card {
        width: 100%;
        max-width: 720px;
        background: white;
        padding: 40px;
        border-radius: 22px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
    }

    /* TITLE */

    .booking-title {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
    }

    /* BUTTON */

    .btn-submit {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #4CAF50, #2ecc71);
        color: white;
        font-size: 16px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
    }


    /* MOBILE RESPONSIVE */

    @media(max-width:768px) {

        .booking-card {
            padding: 25px;
            border-radius: 18px;
        }

        .booking-title {
            font-size: 20px;
        }

    }
</style>


<script>
    const laki = document.querySelector('input[name="jumlah_laki"]');
    const perempuan = document.querySelector('input[name="jumlah_perempuan"]');
    const pendamping = document.querySelector('input[name="jumlah_pendamping"]');
    const total = document.getElementById("totalPeserta");

    function hitungTotal() {

        const l = parseInt(laki.value) || 0;
        const p = parseInt(perempuan.value) || 0;
        const d = parseInt(pendamping.value) || 0;

        total.value = l + p + d;

    }

    laki.addEventListener("input", hitungTotal);
    perempuan.addEventListener("input", hitungTotal);
    pendamping.addEventListener("input", hitungTotal);
</script>

@endsection