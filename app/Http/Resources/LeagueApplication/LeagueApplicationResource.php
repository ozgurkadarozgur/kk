<?php

namespace App\Http\Resources\LeagueApplication;

use Illuminate\Http\Resources\Json\JsonResource;

class LeagueApplicationResource extends JsonResource
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
