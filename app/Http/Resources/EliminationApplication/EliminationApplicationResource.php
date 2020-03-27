<?php

namespace App\Http\Resources\EliminationApplication;

use Illuminate\Http\Resources\Json\JsonResource;

class EliminationApplicationResource extends JsonResource
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
            'team' => [
                'id' => $this->team->id,
                'title' => $this->team->title,
                'power' => 90,
            ],
        ];
    }
}
