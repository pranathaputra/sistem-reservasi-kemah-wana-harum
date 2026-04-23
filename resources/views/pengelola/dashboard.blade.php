@extends('layouts.pengelola')

@section('content')

<div class="topbar">

    <input type="text" placeholder="Search..." class="search-box">

    <div class="profile">
        Admin
    </div>

</div>


<h2 class="section-title">Dashboard</h2>


<div class="card-container">

    <div class="card">
        <div class="card-icon blue">📦</div>
        <div>
            <h4>Total Pemesanan</h4>
            <p>{{ $totalPemesanan }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-icon orange">⏳</div>
        <div>
            <h4>Menunggu Persetujuan</h4>
            <p>{{ $pending }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-icon green">✅</div>
        <div>
            <h4>Sudah Check-in</h4>
            <p>{{ $sudahCheckin }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-icon red">💳</div>
        <div>
            <h4>Belum Bayar</h4>
            <p>{{ $belumBayar }}</p>
        </div>
    </div>

</div>


<div class="table-section">

    <h3>Total Pemesanan Terbaru</h3>

    <table class="table-dashboard">

        <thead>
            <tr>
                <th>Instansi</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Total Peserta</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach($pemesananTerbaru as $item)
            <tr>

                <td>{{ $item->instansi }}</td>

                <td>{{ $item->tanggal_mulai }}</td>

                <td>{{ $item->tanggal_selesai }}</td>

                <td>
                    {{ $item->jumlah_laki +
$item->jumlah_perempuan +
$item->jumlah_pendamping }}
                </td>

                <td>
                    <span class="status {{ $item->status }}">
                        {{ $item->status }}
                    </span>
                </td>

            </tr>
            @endforeach

        </tbody>

    </table>

</div>

@endsection