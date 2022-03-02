<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }

    public function filterElements()
    {
        return $this->belongsToMany(FilterElement::class, 'element_products', 'product_id', 'element_id');
    }
}
