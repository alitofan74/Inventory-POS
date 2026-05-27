<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'produk_id',
        'jumlah_jual',
        'jenis_jual',
        'harga_jual',
        'jumlah_bayar',
        'kembalian'
    ];
}
