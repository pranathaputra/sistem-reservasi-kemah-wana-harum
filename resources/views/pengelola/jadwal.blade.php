<h2>Jadwal Kemah Terdaftar</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Instansi</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Total Peserta</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

    @forelse($jadwals as $jadwal)

        <tr>
            <td>{{ $jadwal->instansi }}</td>
            <td>{{ $jadwal->tanggal_mulai }}</td>
            <td>{{ $jadwal->tanggal_selesai }}</td>
            <td>{{ $jadwal->jumlah_peserta }}</td>
            <td>{{ $jadwal->status }}</td>
        </tr>

    @empty

        <tr>
            <td colspan="5" align="center">
                Belum ada jadwal kemah
            </td>
        </tr>

    @endforelse

    </tbody>
</table>