<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class OverProduct extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'over_product_id', 'qty_over', 'kondisi', 'note', 'image'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('id', 'qty_over', 'kondisi');
    }

    public function getImage()
    {
        if ($this->image != null) {
            return Storage::url('over-products/' . $this->image);
        } else {
            return Storage::url('broken-image.png');
        }
    }
}
