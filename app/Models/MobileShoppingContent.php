<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class MobileShoppingContent extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'text',
    ];
}
