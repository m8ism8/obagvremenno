<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class StoresKazakhstan extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title',
        'image',
        'address',
        'number',
        'time'
    ];

    protected $translatable = [
        'title',
    ];
}
