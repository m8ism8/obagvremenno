<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterElement extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class, 'element_products', 'element_id', 'product_id');
    }

    public function category(){
        return $this->belongsTo(FilterCategory::class);
    }
}