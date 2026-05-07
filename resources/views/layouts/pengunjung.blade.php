@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <title>Dashboard Pengunjung</title>


    <style>
        /* ================= GLOBAL ================= */

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #ffffff;
            overflow-x: hidden;
            padding-top: 80px;
        }


        /* ================= NAVBAR ================= */

        .navbar {

            margin: 18px 50px;
            padding: 14px 40px;

            background: rgba(255, 255, 255, .95);
            backdrop-filter: blur(10px);

            border-radius: 22px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);

            position: sticky;
            top: 10px;

            z-index: 1100;

        }

        .navbar-brand {

            display: flex;
            align-items: center;
            gap: 15px;

            font-weight: 600;
            font-size: 20px;

        }

        .navbar-brand img {
            height: 55px;
        }

        .navbar-menu {

            display: flex;
            align-items: center;
            gap: 22px;

        }

        .navbar-menu a {

            text-decoration: none;
            color: #333;
            font-weight: 500;

        }

        .navbar-menu a:hover {
            color: #4CAF50;
        }

        .logout-btn {

            background: linear-gradient(135deg, #4CAF50, #2ecc71);

            color: white;
            padding: 10px 22px;

            border-radius: 999px;
            text-decoration: none;

            font-weight: 600;

        }

        .navbar-custom {

            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);

            width: 90%;
            max-width: 1200px;

            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);

            padding: 15px 40px;

            border-radius: 18px;

            display: flex;
            justify-content: center;

            z-index: 999;

            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.08);
        }

        .nav-container {

            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {

            display: flex;
            align-items: center;
            gap: 10px;

            color: #2c3e50;
            font-weight: 600;
        }

        .nav-logo img {

            width: 38px;
        }

        .nav-menu {

            display: flex;
            gap: 35px;

            list-style: none;
        }

        .nav-menu a {

            text-decoration: none;
            color: #34495e;

            font-weight: 500;

            transition: 0.25s;
        }

        .nav-menu a:hover {

            color: #27ae60;
        }

        .nav-user {

            display: flex;
            align-items: center;
            gap: 15px;

            color: #2c3e50;
        }

        .btn-logout {

            background: #27ae60;
            border: none;

            padding: 8px 18px;
            border-radius: 20px;

            color: white;
            font-weight: 600;

            cursor: pointer;

            transition: 0.3s;
        }

        .btn-logout:hover {

            background: #219150;
        }

        .navbar-full {

            width: 100%;
            background: white;

            position: fixed;
            top: 0;
            left: 0;

            z-index: 999;

            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-wrapper {

            max-width: 1300px;
            margin: auto;

            padding: 14px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* kiri */

        .nav-left {

            display: flex;
            align-items: center;
            gap: 10px;

            font-weight: 600;
            color: #2c3e50;
        }

        .nav-left img {

            width: 38px;
        }

        /* tengah */

        .nav-center {

            display: flex;
            gap: 35px;

            list-style: none;
        }

        .nav-center a {

            text-decoration: none;
            color: #555;

            font-weight: 500;

            transition: 0.25s;
        }

        .nav-center a:hover {

            color: #27ae60;
        }

        /* kanan */

        .nav-right {

            display: flex;
            align-items: center;
            gap: 15px;
        }

        .username {

            font-weight: 500;
            color: #2c3e50;
        }

        .logout-btn {

            background: #27ae60;
            border: none;

            padding: 8px 18px;

            border-radius: 8px;

            color: white;
            font-weight: 600;

            cursor: pointer;
        }

        .navbar-main {

            width: 100%;
            background: #ffffff;

            position: fixed;
            top: 0;
            left: 0;

            height: 75px;

            display: flex;
            align-items: center;

            box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.06);

            z-index: 999;
        }

        .navbar-container {

            width: 92%;
            max-width: 1300px;

            margin: auto;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* kiri */

        .navbar-left {

            display: flex;
            align-items: center;
            gap: 12px;

            font-size: 18px;
            font-weight: 600;

            color: #2c3e50;
        }

        .navbar-left img {

            width: 42px;
            height: auto;
        }

        /* tengah */

        .navbar-menu {

            display: flex;
            gap: 40px;

            list-style: none;

            margin: 0;
        }

        .navbar-menu a {

            text-decoration: none;

            font-weight: 500;

            color: #555;

            transition: 0.25s ease;
        }

        .navbar-menu a:hover {

            color: #27ae60;
        }

        /* kanan */

        .navbar-right {

            display: flex;
            align-items: center;
            gap: 18px;
        }

        .username {

            font-weight: 500;
            color: #2c3e50;
        }

        .btn-logout {

            background: #27ae60;
            border: none;

            padding: 8px 20px;

            border-radius: 8px;

            color: white;

            font-weight: 600;

            cursor: pointer;

            transition: 0.3s ease;
        }

        .btn-logout:hover {

            background: #219150;
        }

        /* supaya konten tidak ketutup navbar */

        body {

            padding-top: 60px;
        }

        /* ================= HERO FULLSCREEN ================= */

        .hero-fullscreen {

            height: 100vh;

            background-image: url("/images/foto_kemah.jpeg");

            background-size: cover;

            background-position: center;

            display: flex;

            align-items: center;

            padding-left: 120px;

            position: relative;

        }

        /* gradient kiri cinematic */

        .hero-fullscreen::before {

            content: "";

            position: absolute;

            left: 0;
            top: 0;

            width: 60%;
            height: 100%;

            background: linear-gradient(to right,
                    rgba(255, 255, 255, 0.95),
                    rgba(255, 255, 255, 0.6),
                    transparent);

        }

        /* overlay teks */

        .hero-overlay {

            position: relative;

            z-index: 2;

            max-width: 600px;

            color: #2c3e50;

        }

        /* subtitle kecil */

        .hero-small-text {

            letter-spacing: 4px;

            font-size: 14px;

            opacity: .8;

            margin-bottom: 10px;

        }

        /* judul besar */

        .hero-overlay h1 {

            font-size: 72px;

            font-weight: 700;

            line-height: 1.1;

            margin-bottom: 20px;

        }

        /* deskripsi */

        .hero-overlay p {

            font-size: 16px;

            opacity: .9;

            margin-bottom: 35px;

        }

        /* tombol outline putih */

        .hero-btn-outline {

            border: 2px solid #27ae60;

            color: #27ae60;

            padding: 12px 30px;

            border-radius: 40px;

            text-decoration: none;

            transition: .3s;

        }

        .hero-btn-outline:hover {

            background: #27ae60;

            color: white;

        }

        /* ================= SIDEBAR MOBILE ================= */

        .hamburger {

            font-size: 24px;
            cursor: pointer;

            display: none;

        }

        .sidebar {

            position: fixed;
            top: 0;
            left: 0;

            height: 100vh;
            width: 75%;
            max-width: 280px;

            background: white;

            transform: translateX(-100%);
            transition: .3s ease;

            z-index: 1200;

            padding-top: 90px;
            padding-left: 25px;

        }

        .sidebar.show {

            transform: translateX(0);

            box-shadow: 0 0 40px rgba(0, 0, 0, .25);

        }

        .sidebar a {

            display: block;

            margin-bottom: 18px;
            font-size: 18px;

            text-decoration: none;
            color: #333;

        }

        .sidebar a:hover {
            color: #4CAF50;
        }


        /* overlay */

        #sidebarOverlay {

            position: fixed;

            top: 0;
            left: 0;

            width: 100%;
            height: 100vh;

            background: rgba(0, 0, 0, .4);

            opacity: 0;
            visibility: hidden;

            transition: .3s ease;

            z-index: 1100;

        }

        #sidebarOverlay.show {

            opacity: 1;
            visibility: visible;

        }


        /* ================= FOOTER ================= */

        .footer {

            background: #111;
            color: white;

            padding: 50px 40px 20px;

            text-align: center;

            margin-top: 80px;

        }


        /* ================= MOBILE ================= */

        @media(max-width:768px) {

            .navbar {

                margin: 10px 12px;
                padding: 14px;

            }

            .navbar-menu {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .hero-fullscreen {

                height: auto;
                padding: 40px 20px;

            }

            .hero-overlay h1 {
                font-size: 28px;
            }

            .hero-overlay p {
                font-size: 14px;
            }

        }

        .booking-wrapper {
            display: flex;
            justify-content: center;

            margin-top: 100px;
            margin-bottom: 60px;
        }

        .booking-card {

            background: white;
            padding: 30px 40px;

            border-radius: 16px;

            box-shadow: 0px 6px 25px rgba(0, 0, 0, 0.06);

            max-width: 850px;
            width: 100%;

            text-align: center;
        }

        .booking-header {

            display: flex;
            justify-content: center;
            align-items: center;

            gap: 10px;

            margin-bottom: 10px;
        }

        .calendar-icon {

            font-size: 22px;
        }

        .booking-subtitle {

            color: #777;
            margin-bottom: 20px;
        }

        .booking-dates {

            display: flex;
            flex-wrap: wrap;

            justify-content: center;
            gap: 12px;
        }

        .date-badge {

            background: #ffeaea;

            color: #d63031;

            padding: 8px 16px;

            border-radius: 999px;

            font-size: 14px;
            font-weight: 500;

            transition: 0.25s ease;
        }

        .date-badge:hover {

            background: #ffd6d6;
        }

        .availability-wrapper {
            display: flex;
            justify-content: center;

            margin-top: 100px;
            margin-bottom: 60px;
        }

        .availability-card {

            background: white;

            border-radius: 18px;

            padding: 35px 40px;

            max-width: 900px;
            width: 100%;

            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
        }

        .availability-header {

            display: flex;
            align-items: center;

            gap: 15px;

            margin-bottom: 25px;
        }

        .availability-icon {

            font-size: 28px;
        }

        .availability-header h3 {

            margin: 0;
        }

        .availability-header p {

            margin: 0;
            color: #888;
        }


        /* GRID TANGGAL */

        .availability-grid {

            display: grid;

            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));

            gap: 15px;
        }


        /* ITEM */

        .availability-item {

            display: flex;
            align-items: center;
            justify-content: space-between;

            background: #fff5f5;

            border: 1px solid #ffdede;

            border-radius: 12px;

            padding: 12px 18px;

            transition: 0.25s ease;
        }

        .availability-item:hover {

            transform: translateY(-2px);

            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        }


        /* DOT STATUS */

        .status-dot {

            width: 10px;
            height: 10px;

            background: #ff4d4d;

            border-radius: 50%;
        }


        /* TEXT */

        .date-text {

            font-weight: 500;

            color: #444;

            flex: 1;

            margin-left: 10px;
        }


        /* LABEL */

        .status-label {

            font-size: 12px;

            background: #ffe0e0;

            color: #d63031;

            padding: 4px 10px;

            border-radius: 6px;

            font-weight: 600;
        }

        section {
            margin-top: 80px;
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        /* ===== MODERN SECTION ===== */

        .explore-section {
            padding: 80px 60px;
            text-align: center;
            background: #f8f9fa;
        }

        .explore-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .explore-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
        }

        .explore-card:hover {
            transform: translateY(-5px);
        }

        .explore-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .explore-text {
            padding: 15px;
        }

        /* ===== ACTIVITY ===== */

        .activity-section {
            padding: 80px 60px;
            gap: 40px;
            padding: 80px 60px;
            align-items: center;
        }

        .activity-left {
            max-width: 400px;
        }

        .activity-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            flex: 1;
        }

        .activity-card {
            height: 120px;
            background: url("/images/foto_kemah.jpeg") center/cover;
            border-radius: 12px;
        }

        .activity-scroll {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 10px;
        }

        .activity-scroll::-webkit-scrollbar {
            display: none;
        }

        .activity-item {
            min-width: 380px;
            /* dari 300 → lebih lebar */
            height: 200px;
            background: url("/images/foto_kemah.jpeg") center/cover;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        /* wrapper */
        .activity-wrapper {
            position: relative;
        }

        /* scroll */
        .activity-scroll {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            padding: 10px 40px;
        }

        .activity-scroll::-webkit-scrollbar {
            display: none;
        }

        /* item */
        .activity-item {
            min-width: 380px;
            height: 200px;
            background: url("/images/foto_kemah.jpeg") center/cover;
            border-radius: 16px;
            flex-shrink: 0;
            scroll-snap-align: start;
            transition: 0.3s;
        }

        .activity-item:hover {
            transform: scale(1.05);
        }

        /* tombol */
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 10;
        }

        .scroll-btn.left {
            left: 5px;
        }

        .scroll-btn.right {
            right: 5px;
        }

        .activity-wrapper {
            position: relative;
            margin-top: 30px;
        }

        .activity-scroll {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 10px 40px;
            cursor: grab;
        }

        .activity-scroll:active {
            cursor: grabbing;
        }

        .activity-item {
            min-width: 380px;
            height: 200px;
            border-radius: 16px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

</head>


<body>

    <div id="sidebarOverlay"></div>


    <!-- NAVBAR -->

    <nav class="navbar-main">

        <div class="navbar-container">

            <!-- LOGO -->
            <div class="navbar-left">
                <img src="{{ asset('images/logo_wana_harum_nobg.png') }}" alt="logo">
                <span>Bumi Perkemahan Wana Harum</span>
            </div>

            <!-- MENU -->
            @auth

            <!-- MENU SAAT LOGIN -->
            <ul class="navbar-menu">
                <li><a href="{{ route('dashboard.pengunjung') }}">Dashboard</a></li>
                <li><a href="{{ route('pesan.tempat') }}">Pesan Tempat</a></li>
                <li><a href="{{ route('riwayat.pemesanan') }}">Riwayat</a></li>
                <li><a href="{{ route('pengunjung.review') }}">Review</a></li>
            </ul>

            <div class="navbar-right">
                <span class="username">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn-logout">Logout</button>
                </form>
            </div>

            @else

            <!-- MENU SAAT BELUM LOGIN -->
            <ul class="navbar-menu">
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>

            @endauth
    </nav>

    <!-- SIDEBAR MOBILE -->

    <div id="sidebar"
        class="sidebar">

        <a href="{{ route('dashboard.pengunjung') }}">Dashboard</a>

        <a href="{{ route('pesan.tempat') }}">Pesan Tempat</a>

        <a href="{{ route('riwayat.pemesanan') }}">Riwayat</a>

        <a href="{{ route('pengunjung.review') }}">Review</a>

        @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="
        background:none;
        border:none;
        color:red;
        font-size:18px;
        cursor:pointer;
        margin-bottom:18px;
    ">
                Logout
            </button>
        </form>
        @endauth
    </div>


    <!-- CONTENT -->

    <div id="mainContent">

        @yield('content')

        <footer class="footer">

            {{ date('Y') }}
            Sistem Informasi Pemesanan Tempat Kemah | Wana Harum

        </footer>

    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const toggleBtn = document.getElementById("toggleSidebar");

            const sidebar = document.getElementById("sidebar");

            const overlay = document.getElementById("sidebarOverlay");

            if (toggleBtn) {

                toggleBtn.addEventListener("click", function() {

                    sidebar.classList.toggle("show");

                    overlay.classList.toggle("show");

                });

            }

            if (overlay) {

                overlay.addEventListener("click", function() {

                    sidebar.classList.remove("show");

                    overlay.classList.remove("show");

                });

            }

        });
    </script>
    <script>
        function scrollActivity(direction) {
            const container = document.getElementById('activityScroll');
            const scrollAmount = 400;
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        /* drag pakai mouse */
        const slider = document.getElementById('activityScroll');

        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => isDown = false);
        slider.addEventListener('mouseup', () => isDown = false);

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2;
            slider.scrollLeft = scrollLeft - walk;
        });
    </script>
    <script>
        document.querySelectorAll('.activity-item').forEach(item => {
            const bg = item.getAttribute('data-bg');
            item.style.backgroundImage = `url(${bg})`;
        });
    </script>
</body>

</html>