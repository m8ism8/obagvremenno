<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constructor extends Model
{
    use HasFactory;

    public function categories(){
        return $this->hasMany(ConstructorCategory::class);
    }

    public function types(){
        return $this->hasMany(ConstructorType::class);
    }
}
