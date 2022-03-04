<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\{
    ConstructorCategoryResource,
    ConstructorTypeResource,
};

class ConsrtuctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'image' => env('APP_URL').'/storage/'.$this->image,
            'slug' => $this->slug,
            'categories' => ConstructorCategoryResource::collection($this->categories),
            'types' => ConstructorTypeResource::collection($this->types)
        ];
    }
}
