<?php

namespace App\Models;

use App\Mail\NotifyMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\String\s;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'badge',
        'price',
        'new_price',
        'available',
        'characteristics',
        'description',
        'image',
        'video',
        'subcategory_id',
        'complete_id',
        'remainder'
    ];

    public static function boot()
    {
        static::updating(function ($data) {
            if ($data->available) {
                $notification = NotifyProduct::query()
                                               ->where('product_id', $data['id'])
                                               ->get();

                foreach ($notification as $item) {
                    try {
                    \Illuminate\Support\Facades\Mail::to($item->email)->send(new NotifyMail($data));
                    }catch (\Exception $exception) {

                    }
                }

            }
        });
        parent::boot(); // TODO: Change the autogenerated stub
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }

    public function filterElements()
    {
        return $this->belongsToMany(FilterElement::class, 'element_products', 'product_id', 'element_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class)->where('is_approved', '1')->orderBy('created_at', 'desc');
    }
}
