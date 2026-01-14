<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    protected $fillable = [
        'bisnis_kategori_id',
        'nama_unit',
        'logo',
        'alamat',
        'telepon',
        'email',
        'deskripsi',
        'created_at',
    ];

    public function kategori()
    {
        return $this->belongsTo(BisnisKategori::class, 'bisnis_kategori_id');
    }
}
