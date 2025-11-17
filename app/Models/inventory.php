<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'unit_barang',
        'deskripsi_barang',
        'tgl_pemasukan_barang',
        'tgl_kadaluwarsa_barang',
    ];
}
