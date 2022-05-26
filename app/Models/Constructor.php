<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Constructor extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'title',
        'description'
    ];

    public function categories(){
        return $this->hasMany(ConstructorCategory::class);
    }

    public function types(){
        return $this->hasMany(ConstructorType::class);
    }

    public function elements(){
        return $this->hasManyThrough(ConstructorElement::class, ConstructorCategory::class, 'element_id', 'category_id');
    }
}
