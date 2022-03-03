<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'price' => $this->price,
            'image' => env('APP_URL').'/storage/'.$this->image,
        ];
    }
}
