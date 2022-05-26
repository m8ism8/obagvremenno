<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
