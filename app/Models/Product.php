<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_po', 'nama_barang', 'satuan', 'tgl_produksi', 'expired', 'status'
    ];
}
