<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLoker extends Model
{
    use HasFactory;

    protected $table = 'category_lokers';

    protected $fillable = [
        'nama_kategori',
        'keterangan',
    ];
}
