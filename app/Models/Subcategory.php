<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Subcategory extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'title',
    ];

    protected $fillable = ['title', 'image', 'category_id', 'is_top'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'subcategories_products');
    }
}
