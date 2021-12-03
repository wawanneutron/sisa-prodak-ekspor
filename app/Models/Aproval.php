<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'over_product_id',  'kd_pengajuan', 'catatan', 'kondisi'
    ];

    public function overProduct()
    {
        return $this->belongsTo(OverProduct::class);
    }

    /*
        many to many (use pivot tale)
        public function overProducts()
        {
            return $this->belongsToMany(OverProduct::class)->withPivot('id');
        }
    */
}
