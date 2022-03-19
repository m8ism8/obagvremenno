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
        'address',
        'payment_status',
        'payment_id',
        'bonuses_accrued',
        'status'
    ];
    public static function boot()
    {
        parent::boot();
        static::updating(function ($cart){
            if ($cart->status_id == 5) {
                $user = User::query()
                            ->find($cart->user_id);
                $bonus = $user->bonus;
                $user->update([
                    'bonus' => $bonus + $cart->bonuses_accrued
                ]);
            }
        });
    }
    public function elements(){
        return $this->hasMany(CartElement::class);
    }
}
