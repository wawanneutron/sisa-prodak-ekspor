<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'over_product_id', 'users_id', 'kd_pengajuan', 'catatan', 'kondisi'
    ];

    public function overProducts()
    {
        return $this->belongsToMany(OverProduct::class);
    }
}
