<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TCG\Voyager\Traits\Translatable;

class CompleteCategory extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'title'
    ];

    protected $fillable = [
        'title',
        'image',
        'subcategory_id'
    ];

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'ref_complete_products');
    }
}
