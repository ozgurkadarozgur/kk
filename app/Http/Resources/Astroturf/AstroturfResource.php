<?php

namespace App\Http\Resources\Astroturf;

use Illuminate\Http\Resources\Json\JsonResource;

class AstroturfResource extends JsonResource
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
            'city' => $this->city,
            'district' => $this->district,
            'phone' => $this->phone,
            'address' => $this->address,
            'price' => $this->price,
            'work_hour_start' => $this->work_hour_start,
            'work_hour_end' => $this->work_hour_end,
            'services' => $this->service_list,
        ];
    }
}
