<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'subcategory_id'
    ];
}
