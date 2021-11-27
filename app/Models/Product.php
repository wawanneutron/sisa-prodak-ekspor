<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_po', 'nama_barang', 'satuan', 'qty', 'tgl_produksi', 'tgl_export', 'export_country', 'expired', 'status'
    ];
}
