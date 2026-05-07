@extends('layouts.pengunjung')

@section('content')

<!-- HERO MODERN -->
<div class="hero-fullscreen">

    <div class="hero-overlay">

        <div class="hero-small-text">
            BUMI PERKEMAHAN
        </div>

        <h1>WANA HARUM</h1>

        <p>
            Nikmati pengalaman berkemah yang nyaman, aman,
            dan menyenangkan bersama keluarga, sekolah,
            maupun komunitas.
        </p>

        @auth
        <a href="{{ route('pesan.tempat') }}" class="hero-btn-outline">
            Pesan Tempat Sekarang
        </a>
        @endauth

        @guest
        <a href="{{ route('login') }}" class="hero-btn-outline">
            Login untuk Pemesanan
        </a>
        @endguest

    </div>

</div>

<!-- BOOKING -->
<div class="availability-wrapper">

    <div class="availability-card">

        <div class="availability-header">

            <div class="availability-icon">📅</div>

            <div>
                <h3>Tanggal Tidak Tersedia</h3>
                <p>
                    Total booking aktif:
                    <strong>{{ count($bookings) }}</strong> jadwal
                </p>
            </div>

        </div>

        <div class="availability-grid">

            @foreach($bookings as $booking)

            <div class="availability-item">

                <div class="status-dot"></div>

                <div class="date-text">
                    {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                    -
                    {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                </div>

                <div class="status-label">
                    Unavailable
                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

<!-- AREA FAVORIT (BARU - UI ONLY) -->
<section class="explore-section">

    <h2>Area Favorit</h2>

    <div class="explore-grid">

        <div class="explore-card">
            <img src="{{ asset('images/foto_kemah.jpeg') }}">
            <div class="explore-text">
                <h5>Area Keluarga</h5>
                <p>Nyaman & luas</p>
            </div>
        </div>

        <div class="explore-card">
            <img src="{{ asset('images/foto_kemah.jpeg') }}">
            <div class="explore-text">
                <h5>Area Komunitas</h5>
                <p>Untuk kegiatan kelompok</p>
            </div>
        </div>

        <div class="explore-card">
            <img src="{{ asset('images/foto_kemah.jpeg') }}">
            <div class="explore-text">
                <h5>Area Alam</h5>
                <p>View terbaik</p>
            </div>
        </div>

    </div>

</section>

<!-- LOKASI -->
<section class="split-section">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-md-6">
                <h2 class="fw-bold">Lokasi</h2>
                <p>
                    Bumi Perkemahan Wana Harum terletak di Banjar Sekartaji,
                    Desa Sesandan, Kabupaten Tabanan, Bali.
                </p>
            </div>

            <div class="col-md-6">
                <iframe
                    src="https://maps.google.com/maps?q=Sesandan%20Tabanan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="300"
                    style="border-radius:15px;">
                </iframe>
            </div>

        </div>

    </div>

</section>

<!-- FASILITAS -->
<section class="section-soft">

    <div class="container">

        <h2 class="fw-bold text-center mb-5">
            Fasilitas
        </h2>

        <div class="row text-center">

            @forelse($fasilitas as $item)

            <div class="col-md-4 mb-4">

                @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}"
                    class="img-fluid rounded shadow-sm mb-3">
                @endif

                <h5>{{ $item->nama_fasilitas }}</h5>
                <p>{{ $item->deskripsi }}</p>

            </div>

            @empty
            <p class="text-muted">Fasilitas belum tersedia</p>
            @endforelse

        </div>

    </div>

</section>

<!-- KEGIATAN (VERSI MODERN) -->
<section class="activity-section">

    <div class="activity-left">
        <h2>Kegiatan Kemah</h2>
        <p>Pilih aktivitas seru selama berkemah di Wana Harum</p>
    </div>

    <div class="activity-wrapper">

        <button class="scroll-btn left" onclick="scrollActivity(-1)">‹</button>

        <div class="activity-scroll" id="activityScroll">

            @foreach($kegiatan as $item)
            <div class="activity-item"
                data-bg="{{ asset('storage/'.$item->foto) }}">
            </div>
            @endforeach

        </div>

        <button class="scroll-btn right" onclick="scrollActivity(1)">›</button>

    </div>

</section>

@endsection