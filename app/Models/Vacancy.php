<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Vacancy extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'name',
        'surname',
        'text'
    ];

    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'text',
        'file'
    ];
}
