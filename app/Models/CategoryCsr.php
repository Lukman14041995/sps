<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoryCsr extends Model
{
    use HasFactory;

    protected $table = 'category_csrs';

    protected $fillable = [
        'nama_kategori',
        'keterangan',
    ];
}
