<h2>Data Pemesanan Pengunjung</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Instansi</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Pendamping</th>
            <th>Total Peserta</th>
            <th>Status</th>
            <th>Pembayaran</th>
            <th>Check-in</th>
           
        </tr>
    </thead>

    <tbody>

        @forelse($pemesanans as $pemesanan)

        <tr>
            <td>{{ $pemesanan->instansi }}</td>
            <td>{{ $pemesanan->tanggal_mulai }}</td>
            <td>{{ $pemesanan->tanggal_selesai }}</td>

            <td>{{ $pemesanan->jumlah_laki }}</td>
            <td>{{ $pemesanan->jumlah_perempuan }}</td>
            <td>{{ $pemesanan->jumlah_pendamping }}</td>

            <td>
                {{ $pemesanan->jumlah_laki
                 + $pemesanan->jumlah_perempuan
                 + $pemesanan->jumlah_pendamping }}
            </td>

            <td>{{ $pemesanan->status }}</td>
            <td>{{ $pemesanan->status_pembayaran }}</td>
            <td>{{ $pemesanan->status_checkin }}</td>

            <td>

                @if($pemesanan->status_pembayaran == 'berhasil' && !$pemesanan->kode_tiket)
                <a href="{{ route('admin.generate.tiket', $pemesanan->id) }}">
                    🎫 Generate Tiket
                </a>
                @endif

            </td>
        </tr>

        @empty

        <tr>
            <td colspan="11" align="center">
                Belum ada data pemesanan
            </td>
        </tr>

        @endforelse
        

    </tbody>
</table>