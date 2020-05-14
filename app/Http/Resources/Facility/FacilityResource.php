<?php

namespace App\Http\Resources\Facility;

use App\Http\Resources\Astroturf\AstroturfResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
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
            'title' => $this->title,
            'owner' => $this->owner,
            'phone' => $this->phone,
            'city' => $this->city->title,
            'district' => $this->district->title,
            'astroturfs' => AstroturfResource::collection($this->astroturfs),
        ];
    }
}
