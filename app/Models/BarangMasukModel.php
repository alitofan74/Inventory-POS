<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\ProdukModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasukModel extends Model
{
    use HasFactory;
    protected $table = "barang_masuk";
    protected $primarykey = 'id';
    protected $fillable = [
        'tanggal_masuk',
        'jumlah_masuk',
        'keterangan',
        'produk_id',
    ];


    protected $appends = [
        "date_created",
        "date_modified",
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

    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'produk_id');
    }
}
