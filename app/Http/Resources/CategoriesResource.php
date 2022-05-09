<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CategoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $image = $this->image;

        if($image && str_split($image, 4)[0] != 'http' ) {
            $image = env('APP_URL').'/storage/'.$this->image;
        }
            return [
                'id' => $this->id,
                'title' => $this->title,
                'text' => $this->text,
                'image' => $image,
                'slug' => Str::slug($this->title),
                'subcategories' => SubcategoriesResource::collection($this->subcategories),
                'constructor' => new ConstructorResource($this->constructor)
            ];

    }
}
