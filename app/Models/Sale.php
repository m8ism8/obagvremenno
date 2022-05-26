<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Sale extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'title',
        'text',
        'subtitle',
        'second_title',
        'second_subtitle',
        'second_text',
        'third_title',
        'third_subtitle',
        'third_text',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_products');
    }
}
