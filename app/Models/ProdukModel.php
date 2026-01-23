<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProdukModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_produk',
        "harga_beli",
        "harga_jual",
        "stok",
        "gambar",
        "kategori_produk_id",
        'deskripsi'
    ];

    protected $appends = [
        "date_created",
        "date_modified",
        "stok_barang"
    ];

    public function getDateCreatedAttribute()
    {
        return Carbon::parse($this->created_at)
            ->translatedFormat('d M Y, H:i');
    }

    public function getDateModifiedAttribute()
    {
        return Carbon::parse($this->updated_at)
            ->translatedFormat('d M Y, H:i');
    }

    public function getStokBarangAttribute(){
        return $this->stok." pcs";
    }


    public function kategori()
    {
        return $this->belongsTo(KategoriProdukModel::class, 'kategori_produk_id');
    }

}
