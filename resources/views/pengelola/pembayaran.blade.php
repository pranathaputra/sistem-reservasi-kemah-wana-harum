<h2>Data Pembayaran</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Instansi</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Kode Pembayaran</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @foreach($payments as $payment)

        <tr>
            <td>{{ $payment->instansi }}</td>
            <td>{{ $payment->tanggal_mulai }}</td>
            <td>{{ $payment->tanggal_selesai }}</td>
            <td>{{ $payment->kode_pembayaran }}</td>
            <td>{{ $payment->status }}</td>

            <td>

                @if($payment->status == 'pending')

                <a href="{{ route('admin.pembayaran.berhasil', $payment->pemesanan_id) }}"
                    style="background:green;color:white;padding:6px 10px;border-radius:6px;text-decoration:none;">
                    ✔ Simulasikan Berhasil
                </a>

                @else

                <span style="color:gray;">Sudah Dibayar</span>

                @endif

            </td>

        </tr>

        @endforeach

    </tbody>
</table>