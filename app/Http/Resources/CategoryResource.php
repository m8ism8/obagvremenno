<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\SubcategoriesResource;
use App\Http\Resources\ConstructorResource;

class CategoryResource extends JsonResource
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
            'text' => $this->text,
            'image' => $image,
            'subcategories' => SubcategoriesResource::collection($this->subcategories),
            'constructor' => new ConstructorResource($this->constructor)
        ];
    }
}
