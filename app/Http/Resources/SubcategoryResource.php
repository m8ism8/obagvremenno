<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductResource;

class SubcategoryResource extends JsonResource
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
	    'seo_title' => $this->seo_title,
	    'description' => $this->description,
            'image' => $image,
            'products' => ProductResource::collection($this->products)
        ];
    }
}
