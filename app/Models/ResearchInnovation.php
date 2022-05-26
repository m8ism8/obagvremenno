<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class ResearchInnovation extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'content',
    ];
}
