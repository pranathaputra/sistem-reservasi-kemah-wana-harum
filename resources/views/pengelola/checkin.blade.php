@extends('layouts.pengelola')

@section('content')

<h2>Scan QR Tiket</h2>

<button onclick="openScanner()" class="scan-btn">
    Scan QR Tiket
</button>

<!-- MODAL SCANNER -->
<div id="scannerModal" class="modal">

    <div class="modal-content">

        <h3>Scan QR</h3>
        <h4>
            Total Pengunjung Hadir Hari Ini:
            <span id="counter-hadir">{{ $totalHadir }}</span>
        </h4>
        <div id="reader"></div>

        <button onclick="closeScanner()" class="close-btn">
            Tutup
        </button>

    </div>

</div>
<div id="scan-log" style="
    margin-top:25px;
    background:#f8f9fb;
    padding:15px;
    border-radius:12px;
">

    <h5 style="margin-bottom:10px;">
        Riwayat Scan Tiket
    </h5>

    <div id="log-container">
        <small style="color:#777;">
            Belum ada aktivitas scan
        </small>
    </div>

</div>
@endsection


@section('scripts')

<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let html5QrCode;
    let lastResult = null;
    let scanning = false;

    function openScanner() {

        if (scanning) return;

        scanning = true;

        document.getElementById("scannerModal").style.display = "flex";

        html5QrCode = new Html5Qrcode("reader");

        html5QrCode.start({
                facingMode: "environment"
            }, // kamera belakang HP
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess
        ).catch(err => {

            console.log("Camera gagal:", err);

            Swal.fire("Camera tidak bisa diakses");

        });

    }


    function onScanSuccess(decodedText) {

        if (decodedText === lastResult) return;

        lastResult = decodedText;

        fetch("{{ route('admin.checkin.proses') }}", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    kode_tiket: decodedText
                })

            })
            .then(res => res.json())
            .then(data => {

                Swal.fire({
                    icon: data.status === 'success' ? 'success' : 'error',
                    title: 'Informasi Tiket',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                tambahLog(
                    data.instansi ?? "Tidak diketahui",
                    data.message,
                    data.status
                );
                // UPDATE COUNTER REALTIME
                if (data.status === 'success') {

                    let counter = document.getElementById("counter-hadir");

                    let jumlah = parseInt(counter.innerText);

                    counter.innerText = jumlah + 1;
                }
                setTimeout(() => {
                    lastResult = null;
                }, 1500);

            });

    }


    function closeScanner() {

        if (html5QrCode && scanning) {

            html5QrCode.stop().then(() => {

                scanning = false;

                document.getElementById("scannerModal").style.display = "none";

            });

        }

    }

    function tambahLog(instansi, pesan, status) {
        const container = document.getElementById("log-container");

        const warna =
            status === "success" ?
            "#28a745" :
            "#dc3545";

        const waktu = new Date().toLocaleTimeString();

        const item = document.createElement("div");

        item.style.marginBottom = "6px";

        item.innerHTML = `
        <span style="color:${warna}; font-weight:500;">
            ${instansi}
        </span>
        — ${pesan}
        <small style="color:#888;">(${waktu})</small>
    `;

        container.prepend(item);
    }
</script>

<style>
    .scan-btn {
        background: #2c7be5;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
    }

    .close-btn {
        margin-top: 10px;
        background: #e74c3c;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
    }
</style>

@endsection