<?php

namespace App\Http\Resources;

use App\Models\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        if(json_decode($image, true) != null) {
            $image = json_decode($image, true);
            if ($this->getProducts) {
                for ($i = 0; $i < count($image); $i++) {
                    $image[$i] = env('APP_URL') . '/storage/' . $image[$i];
                }
            } else {
                $image = env('APP_URL') . '/storage/' . $image[0];
            }
        } else {
            $image = env('APP_URL') . '/storage/' . $image;
        }
//        "seo_title" => null
//    "seo_description" => null
//    "seo_content" => null
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
            'complete'  => $this->complete,
            'remainder' => $this->remainder,
            'slug'      => Str::slug($this->title),
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            'seo_content' => $this->seo_content,
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
