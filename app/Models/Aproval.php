<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getImage()
    {
        if (!empty($this->overProduct->image)) {
            return Storage::url('over-products/' . $this->overProduct->image);
        } else {
            return Storage::url('broken-image.png');
        }
    }

    /*
        many to many (use pivot tale)
        public function overProducts()
        {
            return $this->belongsToMany(OverProduct::class)->withPivot('id');
        }
    */
}
