@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <title>Dashboard Pengunjung</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            overflow-x: hidden;
            background: #f4f6f8;
        }

        /* NAVBAR */

        .navbar {
            height: auto;
            margin: 18px 50px;
            transition: 0.3s ease;

            padding: 14px 40px;

            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);

            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;

            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.08);

            position: sticky;
            top: 10px;
            z-index: 1100;
        }

        .navbar-right {
            margin-left: auto;
        }


        .navbar a {
            color: #333;
            text-decoration: none;
            margin-left: 15px;
        }

        .navbar-right a:first-child {
            color: #444;
            font-weight: 500;
        }

        .navbar-right a:last-child {
            background: linear-gradient(135deg, #4CAF50, #2ecc71);
            color: white;
            padding: 10px 22px;
            border-radius: 999px;
            font-weight: 600;
            transition: 0.25s ease;
        }

        .navbar-right a:last-child:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
        }

        .navbar::after {
            content: "";
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 92%;
            height: 1px;
            background: rgba(0, 0, 0, 0.06);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .navbar-brand img {
            height: 55px;
            width: auto;
            border-radius: 50%;
        }

        .navbar-brand span {
            margin: 0;
            padding: 0;
            line-height: 1;
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .hamburger {
            font-size: 24px;
            cursor: pointer;
            margin-right: 15px;
            color: #2d4f7c;
        }


        /* SIDEBAR */

        .sidebar {
            position: fixed;
            top: 100px;
            left: 0;
            width: 230px;
            height: calc(100vh - 100px);

            background: #f8f8f8;

            padding: 25px 20px;

            display: flex;
            flex-direction: column;

            border-right: 1px solid #e5e5e5;

            transition: transform 0.3s ease;
        }



        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-top {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        /* SIDEBAR PROFIL */

        .sidebar-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-name {
            font-weight: 600;
            font-size: 15px;
        }

        .profile-edit {
            font-size: 13px;
            color: #888;
            text-decoration: none;
        }

        .profile-edit:hover {
            color: #4CAF50;
        }

        /* MENU ITEM */
        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .menu-link {
            text-decoration: none;
            color: #666;

            font-size: 18px;

            display: flex;
            align-items: center;
            gap: 14px;

            transition: 0.2s ease;
        }

        .menu-link:hover {
            color: #222;
        }

        .menu-link.active {
            color: black;
            font-weight: 600;
        }

        .sidebar-logout {
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .menu-link.logout {
            color: #555;
        }

        @media (max-width: 768px) {

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .auth-layout .sidebar:not(.collapsed)~#mainContent {
                margin-left: 0;
            }

        }

        /* CONTENT */

        .auth-layout #mainContent {
            margin-left: 0;
        }

        .auth-layout .sidebar:not(.collapsed)~#mainContent {
            margin-left: 230px;
        }

        .auth-layout .sidebar.collapsed~#mainContent {
            margin-left: 0;
        }


        /* HERO */

        .hero {
            height: 520px;
            max-width: 1400px;

            margin: 40px auto 100px auto;

            border-radius: 28px;

            background: url('/images/foto_kemah.jpeg') center/cover no-repeat;

            display: flex;
            align-items: center;

            padding-left: 90px;

            position: relative;
            overflow: hidden;

            box-shadow: 0px 30px 80px rgba(0, 0, 0, 0.15);
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;

            background: linear-gradient(to right,
                    rgba(0, 0, 0, 0.65),
                    rgba(0, 0, 0, 0.35),
                    rgba(0, 0, 0, 0.05));
        }

        .hero-text {
            position: relative;
            max-width: 520px;
            color: white;
        }

        .hero-text h1 {
            font-size: 52px;
            font-weight: 700;
            line-height: 1.2;
        }

        .highlight-text {
            color: #4CAF50;
        }

        .hero-subtitle {
            font-size: 20px;
            margin-top: 15px;
        }

        .hero-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 28px;
            background: linear-gradient(45deg, #4CAF50, #2ecc71);
            color: white;
            border-radius: 30px;
            text-decoration: none;
        }

        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(46, 204, 113, 0.4);
        }

        /* CONTENT SECTION */

        .content {
            padding: 40px;
        }

        .galeri {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .booking-floating {
            position: relative;
            margin-top: -20px;
            display: flex;
            justify-content: center;
        }

        .booking-card {
            width: 85%;
            max-width: 1400px;

            margin: -70px auto 20px auto;
            background: #ffffff;
            padding: 40px 60px;

            border-radius: 24px;

            box-shadow: 0px 20px 60px rgba(0, 0, 0, 0.15);

            text-align: center;
        }

        .booking-card:hover {
            transform: translateY(-5px);
        }

        /* FOOTER */

        .footer {
            background: #111;
            color: white;
            padding: 50px 40px 20px;
            text-align: center;
        }

        .section-heading {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .fasilitas-item {
            border-radius: 15px;
            padding: 20px;
            background: #f8f9fa;
            transition: 0.3s ease;
        }

        .fasilitas-item:hover {
            transform: translateY(-5px);
            background: #e9f7ef;
        }

        .fasilitas-icon {
            font-size: 40px;
            color: #4CAF50;
            margin-bottom: 12px;
        }

        /* ================= MOBILE RESPONSIVE FINAL ================= */

        @media (max-width: 768px) {

            /* NAVBAR */

            .navbar {
                margin: 10px 12px;
                padding: 14px;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                border-radius: 18px;
            }

            .navbar-brand {
                gap: 10px;
            }

            .navbar-brand img {
                height: 38px;
            }

            .navbar-brand span {
                font-size: 15px;
                line-height: 1.3;
            }

            .navbar-right {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 5px;
            }

            /* HERO SECTION */

            .hero {
                margin: 20px 12px 30px 12px;
                padding: 22px;
                height: auto;
                border-radius: 18px;
            }

            .hero-text h1 {
                font-size: 24px;
                line-height: 1.35;
            }

            .hero-subtitle {
                font-size: 14px;
                margin-top: 10px;
            }

            .hero-btn {
                margin-top: 15px;
                padding: 10px 18px;
                font-size: 14px;
                display: inline-block;
            }

            /* BOOKING STATUS CARD */

            .booking-card {
                width: 94%;
                margin: -20px auto 20px auto;
                padding: 22px;
                border-radius: 18px;
            }

            /* CONTENT SECTION */

            .content {
                padding: 18px;
            }

            /* SIDEBAR MOBILE */

            .sidebar {
                top: 75px;
                width: 220px;
            }

            /* FOOTER */

            .footer {
                padding: 25px 12px;
                font-size: 13px;
            }



            @media (max-width:768px) {

                .sidebar.show {
                    box-shadow: 0 0 40px rgba(0, 0, 0, 0.25);
                }

            }

            /* ===== SIDEBAR MOBILE MODERN ===== */

            #sidebarOverlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: rgba(0, 0, 0, 0.4);
                opacity: 0;
                visibility: hidden;
                transition: 0.3s ease;
                z-index: 1100;
            }

            #sidebarOverlay.show {
                opacity: 1;
                visibility: visible;
            }

            /* sidebar mobile animation */

            @media(max-width:768px) {

                /* SIDEBAR WIDTH MOBILE */

                .sidebar {
                    top: 0;
                    left: 0;
                    height: 100vh;
                    width: 75%;
                    max-width: 280px;
                    background: white;
                    transform: translateX(-100%);
                    transition: 0.3s ease;
                    z-index: 1200;
                    padding-top: 90px;
                }

                /* SIDEBAR ACTIVE */

                .sidebar.show {
                    transform: translateX(0);
                    box-shadow: 0 0 40px rgba(0, 0, 0, 0.25);
                }

                /* MAIN CONTENT TIDAK BERGESER */

                .auth-layout .sidebar:not(.collapsed)~#mainContent {
                    margin-left: 0 !important;
                }

            }
        }
    </style>

</head>



<body class="@auth auth-layout @endauth">

    <div id="sidebarOverlay"></div>

    <!-- NAVBAR -->

    <div class="navbar">

        @auth
        <span id="toggleSidebar" class="hamburger">☰</span>
        @endauth

        <div class="navbar-brand">
            <img src="{{ asset('images/logo_wana_harum_nobg.png') }}" alt="Logo">
            <span>Bumi Perkemahan Wana Harum</span>
        </div>

        <div class="navbar-right">

            @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
            @endguest

            @auth
            {{ Auth::user()->name }}
            <a href="/logout">Logout</a>
            @endauth

        </div>

    </div>


    @auth
    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar collapsed">

        <!-- PROFILE -->
        <div class="sidebar-top">

            <div class="sidebar-profile">
                <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="profile-img">

                <div class="profile-info">
                    <span class="profile-name">
                        {{ Auth::user()->name }}
                    </span>

                    <a href="#" class="profile-edit">
                        Edit Profil
                    </a>
                </div>
            </div>

            <!-- MENU -->
            <div class="sidebar-menu">

                <a href="{{ route('dashboard.pengunjung') }}" class="menu-link active">
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>

                <a href="{{ route('pesan.tempat') }}" class="menu-link">
                    <i class="bi bi-calendar-check"></i>
                    Pesan Tempat
                </a>

                <a href="{{ route('riwayat.pemesanan') }}" class="menu-link">
                    <i class="bi bi-clock-history"></i>
                    Riwayat
                </a>

                <a href="{{ route('pengunjung.eticket') }}" class="menu-link">
                    <i class="bi bi-ticket-perforated"></i>
                    E-Ticket
                </a>

                <a href="#" class="menu-link">
                    <i class="bi bi-star"></i>
                    Review
                </a>

            </div>

        </div>

    </div>
    @endauth

    <!-- MAIN CONTENT -->

    <div id="mainContent">
        @yield('content')
        <!-- FOOTER -->

        <footer class="footer">

            {{ date('Y') }} Sistem Informasi Pemesanan Tempat Kemah | Wana Harum

        </footer>

    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");

        if (toggleBtn) {

            toggleBtn.addEventListener("click", function() {

                if (window.innerWidth <= 768) {

                    // MODE MOBILE
                    sidebar.classList.toggle("show");
                    overlay.classList.toggle("show");

                } else {

                    // MODE DESKTOP
                    sidebar.classList.toggle("collapsed");

                }

            });

        }

        /* klik overlay tutup sidebar (mobile saja) */

        if (overlay) {

            overlay.addEventListener("click", function() {

                sidebar.classList.remove("show");
                overlay.classList.remove("show");

            });

        }

    });
</script>

</html>