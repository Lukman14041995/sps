<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BisnisKategori extends Model
{
    protected $table = 'bisnis_kategoris';

    protected $fillable = [
        'nama_kategori',
        'keterangan'
    ];
}

