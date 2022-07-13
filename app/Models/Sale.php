<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Sale extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title',
        'text',
        'image',
        'is_main',
        'preview_image',
        'show'
    ];

    protected $translatable = [
        'title',
        'text'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_products');
    }
}
