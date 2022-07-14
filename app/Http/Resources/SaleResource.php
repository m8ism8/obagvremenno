<?php

namespace App\Http\Resources;

use App\Models\Sale;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'items' => ItemsResource::collection(Sale::all()->where('title', $this->title)),
            'is_main'    => $this->is_main,
            'created_at' => $this->created_at,
            'preview_image' => $this->preview_image,
            'products'   => ProductResource::collection($this->products),
        ];
    }


}
