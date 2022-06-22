<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $translatable = ['headline'];
    protected $fillable = ['headline', 'img_source', 'code'];
}
