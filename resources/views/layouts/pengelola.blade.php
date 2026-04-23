<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Pengelola</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        /* NAVBAR */
        .navbar-admin {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background: #2c7be5;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1001;
        }

        .hamburger-btn {
            font-size: 22px;
            border: none;
            background: none;
            color: white;
            cursor: pointer;
            margin-right: 15px;
        }

        /* SIDEBAR */
        .sidebar-admin {
            width: 250px;
            height: calc(100vh - 60px);
            background: #2c3e50;
            position: fixed;
            left: 0;
            top: 60px;
            transition: 0.3s;
        }

        .sidebar-admin.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 12px 25px;
        }

        .sidebar-menu li a:hover {
            background: #34495e;
        }

        .modal-content {
            background: white;
            padding: 25px;
            border-radius: 18px;
            text-align: center;
            width: 400px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-box {
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            width: 250px;
        }

        .profile {
            font-weight: bold;
        }

        .section-title {
            margin-bottom: 20px;
        }

        .table-section {
            margin-top: 40px;
        }

        .table-dashboard {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.08);
        }

        .table-dashboard th {
            background: #f8f9fc;
            padding: 12px;
            text-align: left;
        }

        .table-dashboard td {
            padding: 12px;
            border-top: 1px solid #eee;
        }

        .status {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            color: white;
        }

        .status.pending {
            background: orange;
        }

        .status.disetujui {
            background: green;
        }

        .status.ditolak {
            background: red;
        }

        /* CONTENT */
        .main-content {
            margin-top: 60px;
            margin-left: 0;
            padding: 20px;
            transition: 0.3s;
        }

        .main-content.shifted {
            margin-left: 250px;
        }

        .card-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card h4 {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .card p {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
        }

        .card-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
        }

        .blue {
            background: #4e73df;
        }

        .orange {
            background: #f6a609;
        }

        .green {
            background: #1cc88a;
        }

        .red {
            background: #e74a3b;
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar-admin">
        <button id="toggleSidebar" class="hamburger-btn">☰</button>
        <h3>Bumi Perkemahan Wana Harum</h3>
    </div>

    <!-- SIDEBAR -->
    <div id="sidebarAdmin" class="sidebar-admin collapsed">

        <div class="sidebar-header">
            <h2>Admin Panel</h2>
        </div>

        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard.pengelola') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.pemesanan') }}">Data Pemesanan</a></li>
            <li><a href="{{ route('admin.jadwal') }}">Jadwal Kemah</a></li>
            <li><a href="{{ route('admin.pembayaran') }}">Pembayaran</a></li>
            <li><a href="{{ route('admin.checkin.form') }}">Scan Tiket</a></li>
            <li><a href="#">Laporan</a></li>
            <li><a href="#">Review Pengunjung</a></li>
        </ul>

    </div>

    <!-- CONTENT -->
    <div class="main-content">

        @yield('content')

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const toggleBtn = document.getElementById("toggleSidebar");
            const sidebar = document.getElementById("sidebarAdmin");
            const content = document.querySelector(".main-content");

            toggleBtn.addEventListener("click", function() {

                sidebar.classList.toggle("collapsed");
                content.classList.toggle("shifted");

            });

        });
    </script>
    @yield('scripts')
</body>

</html>