<?php

namespace App\Http\Resources;

use App\Models\NewSales;
use App\Models\Sale;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'id'         => $this->id,
            'title'      => $this->title,
            'items' => ItemsResource::collection(NewSales::all()->where('title', $this->title)),
            'created_at' => $this->created_at,
            'subtitle' => $this->subtitle,
        ];
    }
}
