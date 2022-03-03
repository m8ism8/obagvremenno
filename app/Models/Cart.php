<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'price',
        'bonus_waste',
        'name',
        'phone',
        'email',
        'delivery_type',
        'payment_type',
    ];

    public function elements(){
        return $this->hasMany(CartElement::class);
    }
}