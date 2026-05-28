<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    use HasFactory;
    protected $table = 'penjualan';

    protected $fillable = [
        'nama_cart',
        'nota',
        'jenis_jual',
        'status',
        'total_harga_jual',
        'total_jumlah_jual',
        'metode_bayar',
        'dibayar',
        'kembalian',
        'held_at',
    ];

    protected $appends = [
        "grandtotal_format"
    ];

    //relationship
    public function details(){
        return $this->hasMany(DetailPenjualanModel::class, 'penjualan_id');
    }

    //helper
    protected static function booted(){
        static::creating(function ($model) {
            if (!$model->nama_cart) {
                $model->nama_cart = 'Cart ' . now()->format('His');
            }
        });
    }

    public function scopeDraft($query){
        return $query->where('status', 'draft');
    }

    public function scopeHold($query){
        return $query->where('status', 'hold');
    }

    public function isDraft(){
        return $this->status === 'draft';
    }

    public function isHold(){
        return $this->status === 'hold';
    }

    public function isComplete(){
        return $this->status === 'complete';
    }

    public function refreshTotal(){
        $this->total_harga_jual = $this->details()->sum('subtotal');
        $this->total_jumlah_jual = $this->details()->sum('jumlah_jual');
        $this->save();
    }

    public function getGrandtotalFormatAttribute(){
        return 'Rp ' . number_format($this->total_harga_jual, 0, ',', '.');
    }

}
