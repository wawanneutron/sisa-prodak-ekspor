<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OverProduct extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'over_product_id', 'qty_over', 'kondisi', 'note'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('id', 'qty_over', 'kondisi');
    }

    // public function overProduct()
    // {
    //     return $this->belongsTo(Product::class);
    // }
}
