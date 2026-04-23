<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'user_id',
        'instansi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_laki',
        'jumlah_perempuan',
        'jumlah_pendamping',
        'status',
        'status_pembayaran',
        'status_checkin',
        'kode_tiket'
    ];
}
