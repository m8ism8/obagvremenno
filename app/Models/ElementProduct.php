<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'element_id',
        'product_id'
    ];
}
