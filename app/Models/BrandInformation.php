<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class BrandInformation extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'text',
    ];
}
