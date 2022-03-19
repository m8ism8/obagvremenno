<?php

namespace App\Http\Resources;

use App\Models\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = $this->image;
        if($image && str_split($image, 4)[0] != 'http' ) {
            $image = env('APP_URL').'/storage/'.$this->image;
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'badge' => $this->badge,
            'price' => $this->price,
            'new_price' => $this->new_price,
            'available' => $this->available,
            'characteristics' => $this->characteristics,
            'description' => $this->description,
            'image' => $image,
            'video' => $this->video ?? null,
            'reviews' => $this->reviews,
            'isFavorite' => $this->isFavorite ?? self::isFavorite($this->id),
            'complete'  => $this->complete
        ];
    }

    public static function isFavorite($id): bool
    {
        return Favourite::query()
            ->where('product_id', $id)
            ->where('user_id', Auth::guard('sanctum')->id())
            ->exists();
    }
}
