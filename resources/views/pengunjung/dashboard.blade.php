@extends('layouts.pengunjung')

@section('content')

        <!-- HERO -->

        <div class="hero">

            <div class="hero-text">

                @guest
                <h1>
                    Jelajahi Keindahan
                    <span class="highlight-text">Bumi Perkemahan</span>
                    Wana Harum
                </h1>
                @endguest


                @auth
                <h1>
                    Selamat Datang,
                    <span class="highlight-text">{{ Auth::user()->name }}</span>
                    Di Bumi Perkemahan Wana Harum
                </h1>
                @endauth


                <p class="hero-subtitle">
                    Nikmati pengalaman berkemah yang nyaman, aman, dan menyenangkan bersama keluarga, sekolah, maupun komunitas.
                </p>


                @guest
                <a href="{{ route('login') }}" class="hero-btn">
                    Login untuk Pemesanan
                </a>
                @endguest


                @auth
                <a href="{{ route('pesan.tempat') }}" class="hero-btn">
                    Pesan Tempat Sekarang
                </a>
                @endauth

            </div>
        </div>

        <div class="booking-floating">

            <div class="booking-card shadow">

                <h4>
                    <i class="bi bi-calendar-check"></i>
                    Tanggal Sudah Dibooking
                </h4>

                @if(isset($bookings) && $bookings->count() > 0)

                @foreach($bookings as $booking)

                <span class="badge bg-danger me-2 mb-2">
                    {{ $booking->tanggal_mulai }}
                    -
                    {{ $booking->tanggal_selesai }}
                </span>

                @endforeach

                @else

                <p class="text-muted">Belum ada pemesanan.</p>

                @endif


                {{-- STATUS TIKET --}}
                @if(isset($pemesanan))

                <hr style="margin:25px 0">

                <strong>Status Tiket:</strong>

                <div style="margin-top:8px">

                    @if($pemesanan->kode_tiket)

                    <span class="text-success fw-semibold">
                        ✅ Tiket siap digunakan
                    </span>

                    <br>

                    <a href="{{ route('pengunjung.eticket') }}">
                        Lihat E-Ticket →
                    </a>

                    @else

                    <span class="text-warning">
                        ⏳ Menunggu pembayaran
                    </span>

                    @endif

                </div>

                @endif

            </div>

        </div>
        <section class="container py-5">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <h2 class="fw-bold">Lokasi Bumi Perkemahan</h2>

                    <p>
                        Bumi Perkemahan Wana Harum terletak di Banjar Sekartaji,
                        Desa Sesandan, Kabupaten Tabanan, Bali. Area ini memiliki
                        luas sekitar 1,2 hektar dan dikelilingi suasana alam yang
                        asri serta nyaman untuk kegiatan perkemahan.
                    </p>
                </div>

                <div class="col-md-6">
                    <iframe
                        src="https://maps.google.com/maps?q=Sesandan%20Tabanan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%"
                        height="300"
                        style="border-radius:15px;">
                    </iframe>
                </div>

            </div>
        </section>

        <!-- FASILITAS -->
        <section class="container py-5">

            <h2 class="fw-bold text-center mb-4">Fasilitas</h2>

            <div class="row text-center">

                <div class="col-md-4 mb-3">
                    <div class="fasilitas-item">
                        <img src="{{ asset('images/fasilitas/kamar_mandi.jpg') }}"
                            class="fasilitas-img">
                        <h5>Kamar Mandi</h5>
                        <p>Tersedia 16 bilik kamar mandi untuk pengunjung.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="fasilitas-item">
                        <img src="{{ asset('images/fasilitas/kamar_mandi.jpg') }}"
                            class="fasilitas-img">
                        <h5>Area Parkir Luas</h5>
                        <p>Mendukung kendaraan roda dua maupun roda empat.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="fasilitas-item">
                        <img src="{{ asset('images/fasilitas/kamar_mandi.jpg') }}"
                            class="fasilitas-img">
                        <h5>Hutan Bambu</h5>
                        <p>Area alami untuk kegiatan edukasi dan eksplorasi.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="fasilitas-item">
                        <img src="{{ asset('images/fasilitas/kamar_mandi.jpg') }}"
                            class="fasilitas-img">
                        <h5>Agro Bunga Sedap Malam</h5>
                        <p>Wisata edukasi tanaman khas daerah.</p>
                    </div>

                </div>

                <div class="col-md-4 mb-3">
                    <div class="fasilitas-item">
                        <img src="{{ asset('images/fasilitas/kamar_mandi.jpg') }}"
                            class="fasilitas-img">
                        <h5>Jalur Tracking</h5>
                        <p>Jalur alam untuk kegiatan petualangan ringan.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="fasilitas-item">
                        <img src="{{ asset('images/fasilitas/kamar_mandi.jpg') }}"
                            class="fasilitas-img">
                        <h5>Area Spiritual (Beji)</h5>
                        <p>Tempat kegiatan spiritual dan budaya lokal.</p>
                    </div>
                </div>


            </div>
        </section>

        <!-- AREA KEMAH -->
        <section class="container py-5">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <h2 class="fw-bold">Area Perkemahan</h2>

                    <p>
                        Bumi Perkemahan Wana Harum memiliki area perkemahan
                        seluas ±1,2 hektar yang dapat digunakan untuk berbagai
                        kegiatan seperti perkemahan sekolah, kegiatan pramuka,
                        pelatihan organisasi, serta kegiatan wisata alam.
                    </p>

                    <p>
                        Area ini didukung dengan lingkungan yang asri, aman,
                        serta fasilitas penunjang yang memadai sehingga
                        cocok untuk kegiatan kelompok dalam jumlah besar.
                    </p>

                </div>

                <div class="col-md-6">

                    <img src="{{ asset('images/area_kemah.jpeg') }}"
                        class="img-fluid rounded shadow"
                        alt="Area Perkemahan">

                </div>

            </div>

        </section>
        </section>
        <!-- GALERI -->

        <div class="container mt-5">

            <h2 class="mb-4">Kegiatan Kemah</h2>


            <!-- API UNGGUN -->
            <div class="row align-items-center mb-5">

                <div class="col-md-6">
                    <img src="{{ asset('images/api_unggun_pramuka.jpeg') }}"
                        class="img-fluid rounded shadow">
                </div>

                <div class="col-md-6">
                    <h3>Api Unggun</h3>
                    <p>
                        Kegiatan malam kebersamaan peserta kemah yang bertujuan
                        mempererat hubungan antar peserta melalui suasana hangat,
                        cerita kelompok, permainan malam, serta refleksi kegiatan.
                    </p>
                </div>

            </div>


            <!-- OUTBOUND -->
            <div class="row align-items-center mb-5 flex-md-row-reverse">

                <div class="col-md-6">
                    <img src="{{ asset('images/outbound.jpeg') }}"
                        class="img-fluid rounded shadow">
                </div>

                <div class="col-md-6">
                    <h3>Outbound</h3>
                    <p>
                        Kegiatan permainan kelompok yang dirancang untuk melatih
                        kerja sama tim, komunikasi efektif, kepemimpinan,
                        serta meningkatkan rasa percaya diri peserta.
                    </p>
                </div>

            </div>


            <!-- JELAJAH ALAM -->
            <div class="row align-items-center mb-5">

                <div class="col-md-6">
                    <img src="{{ asset('images/jelajah_alam.jpeg') }}"
                        class="img-fluid rounded shadow">
                </div>

                <div class="col-md-6">
                    <h3>Jelajah Alam</h3>
                    <p>
                        Kegiatan eksplorasi lingkungan sekitar area perkemahan
                        yang bertujuan mengenalkan peserta pada keanekaragaman
                        alam serta meningkatkan kepedulian terhadap lingkungan.
                    </p>
                </div>

            </div>

        </div>



        
@endsection