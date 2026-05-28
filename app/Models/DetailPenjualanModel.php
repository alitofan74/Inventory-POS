<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualanModel extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualan';

    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'jumlah_jual',
        'harga_jual',
        'subtotal',
    ];

    protected $appends = [
        "harga_jual_format",
        "jumlah_jual_format",
        "subtotal_format"
    ];

    //relationship
    public function penjualan(){
        return $this->belongsTo(PenjualanModel::class, 'penjualan_id');
    }

    public function produk(){
        return $this->belongsTo(ProdukModel::class, 'produk_id');
    }

    //helper
    protected static function booted(){
        static::creating(function ($model) {
            $model->subtotal = $model->jumlah_jual * $model->harga_jual;
        });

        static::updating(function ($model) {
            $model->subtotal = $model->jumlah_jual * $model->harga_jual;
        });

        static::saved(function ($detail) {
            $detail->penjualan->refreshTotal();
        });
    }

    public function getHargaJualFormatAttribute(){
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }

    public function getJumlahJualFormatAttribute(){
        return $this->jumlah_jual. " pcs";
    }

    public function getSubtotalFormatAttribute(){
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
