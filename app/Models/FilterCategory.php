<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class FilterCategory extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'title'
    ];

    protected $fillable = [
        'title'
    ];

    public function elements(){
        return $this->hasMany(FilterElement::class);
    }
}
