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

        <div id="reader"></div>

        <form id="checkinForm" method="POST" action="{{ route('admin.prosesCheckin') }}">
            @csrf
            <input type="hidden" name="kode_tiket" id="kode_tiket">
        </form>

        <button onclick="closeScanner()" class="close-btn">
            Tutup
        </button>

    </div>

</div>

@endsection


@section('scripts')

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let html5QrCode;

function openScanner() {

    document.getElementById("scannerModal").style.display = "flex";

    html5QrCode = new Html5Qrcode("reader");

    Html5Qrcode.getCameras().then(devices => {

        if (devices.length) {

            let cameraId = devices[0].id;

            html5QrCode.start(
                cameraId,
                {
                    fps: 10,
                    qrbox: 250
                },
                qrCodeMessage => {

                    document.getElementById('kode_tiket').value = qrCodeMessage;

                    html5QrCode.stop().then(() => {

                        document.getElementById("scannerModal").style.display = "none";

                        document.getElementById('checkinForm').submit();

                    });

                }
            );

        }

    });

}

function closeScanner() {

    if (html5QrCode) {

        html5QrCode.stop().then(() => {

            document.getElementById("scannerModal").style.display = "none";

        });

    }

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
    background: rgba(0,0,0,0.6);
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