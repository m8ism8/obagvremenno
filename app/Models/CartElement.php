<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'constructor_element_id',
        'certificate_id',
        'cart_id',
        'quantity',
        'price',
        'title'
    ];
}
