<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'full_title', 'text', 'image'];

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
    public function products(){
        //return $this->hasManyThrough(Product::class, Subcategory::class);
        return $this->morphToMany();
    }
    public function constructor(){
        return $this->hasOne(Constructor::class);
    }
}
