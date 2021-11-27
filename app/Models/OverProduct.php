<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverProduct extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'qty_over', 'kondisi', 'note'];
}
