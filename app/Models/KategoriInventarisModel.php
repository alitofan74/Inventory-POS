<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriInventarisModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategori_inventaris';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
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
