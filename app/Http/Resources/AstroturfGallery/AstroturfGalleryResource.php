<?php

namespace App\Http\Resources\AstroturfGallery;

use Illuminate\Http\Resources\Json\JsonResource;

class AstroturfGalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image_url' => $this->image_url,
        ];
    }
}
