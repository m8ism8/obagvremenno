<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructorCategory extends Model
{
    use HasFactory;

    public function constructorElements(){
        return $this->hasMany(ConstructorElement::class, 'category_id');
    }
}
