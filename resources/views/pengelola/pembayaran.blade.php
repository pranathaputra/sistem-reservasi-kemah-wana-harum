<h2>Data Pembayaran</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Instansi</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Kode Pembayaran</th>
            <th>Status</th>
            <th>Status Pembayaran</th>
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
                <span style="background:orange;color:white;padding:6px 10px;border-radius:6px;">
                    Pending
                </span>

                @elseif($payment->status == 'berhasil')
                <span style="background:green;color:white;padding:6px 10px;border-radius:6px;">
                    Berhasil
                </span>

                @elseif($payment->status == 'expired')
                <span style="background:red;color:white;padding:6px 10px;border-radius:6px;">
                    Expired
                </span>

                @endif

            </td>

        </tr>

        @endforeach

    </tbody>
</table>