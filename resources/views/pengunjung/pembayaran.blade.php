@extends('layouts.pengunjung')

@section('content')

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h3>Pembayaran Pemesanan</h3>

        <p>Instansi: {{ $pemesanan->instansi }}</p>
        <p>Tanggal: {{ $pemesanan->tanggal_mulai }} - {{ $pemesanan->tanggal_selesai }}</p>

        <a href="{{ route('pembayaran.berhasil', $pemesanan->id) }}"
           class="btn btn-success">
           Bayar Sekarang
        </a>

    </div>

</div>

@endsection