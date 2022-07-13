<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class NewSales extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title',
        'text',
        'subtitle',
        'image',
        'is_main',
        'show'
    ];

    protected $translatable = [
        'title',
        'text',
        'subtitle'
    ];
}
