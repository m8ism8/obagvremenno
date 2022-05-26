<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class ConstructorCategory extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'title'
    ];

    public function constructorElements(){
        return $this->hasMany(ConstructorElement::class, 'category_id');
    }
}
