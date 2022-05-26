<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class ShippingPayment extends Model
{
    use HasFactory, Translatable;

    protected $translatable = [
        'text',
    ];
}
