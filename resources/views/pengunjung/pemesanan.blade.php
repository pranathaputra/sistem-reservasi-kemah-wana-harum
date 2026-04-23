@extends('layouts.admin')

@section('content')

<h2>Data Pemesanan</h2>

<table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top:20px; background:white; border-radius:10px; overflow:hidden;">
    
    <thead style="background:#f5f5f5;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Tanggal</th>
            <th>Peserta</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Agus</td>
            <td>SMA 1 Bali</td>
            <td>10 - 12 Mei 2026</td>
            <td>30</td>
            <td><span style="color:orange;">Pending</span></td>
            <td>
                <button>Lihat</button>
            </td>
        </tr>
    </tbody>

</table>

@endsection