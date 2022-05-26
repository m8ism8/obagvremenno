<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class City extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'title',
    ];

    public function fillials(){
        return $this->hasMany(Fillial::class);
    }
}
