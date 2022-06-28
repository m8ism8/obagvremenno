<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'complete_id',
        'product_id',
        'img'
    ];
}
