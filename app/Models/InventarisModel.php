<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\KategoriInventarisModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventarisModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "inventaris";
    protected $primarykey = 'id';
    protected $fillable = [
        'nama_inventaris',
        'deskripsi',
        'gambar',
        'kategori_inventaris_id',
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

    public function kategori()
    {
        return $this->belongsTo(KategoriInventarisModel::class, 'kategori_inventaris_id');
    }
}
