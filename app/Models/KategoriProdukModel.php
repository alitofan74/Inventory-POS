<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class KategoriProdukModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategori_produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kategori',
        'deskripsi'
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

}
