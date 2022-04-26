<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoriesResource extends JsonResource
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
        $preview_image = $this->preview_image;
        if(empty($preview_image)) {
            $preview_image = null;
        } else {
            try {
                $preview_image = json_decode($preview_image, true)[0];
                $preview_image = env('APP_URL').'/storage/'.$preview_image['download_link'];
            } catch (\Exception $exception) {
                $preview_image = null;
            }
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $image,
            'preview_image' => $preview_image
        ];
    }
}
